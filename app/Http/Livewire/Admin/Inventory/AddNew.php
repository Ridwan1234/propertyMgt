<?php

namespace App\Http\Livewire\Admin\Inventory;

use App\Models\Property;
use App\Models\PropertyUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNew extends Component
{


    use WithFileUploads;

    public $propertyId;
    public $unitId;
    public $units = [];
    public $inventoryForUnit = false;
    public $photos;
    public $description;

    public $iteration = 0;


    public function render()
    {

        $properties = Property::orderBy('title')->pluck('id', 'title');
        return view('livewire.admin.inventory.add-new', ['properties' => $properties]);
    }

    public function updatedPhotos()
    {
        $this->validate(
            ['photos.*' => 'image|mimes:jpg,png,jpeg,gif|max:5000'],
            ['photos.*.image' => 'Ensure all files uploaded are supported images',
                'photos.*.max' => 'Each image cannot exceed size of 5MB',

            ]
        );
    }

    public function removePhoto($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function updatedPropertyId()
    {
        $this->units = PropertyUnit::where('property_id', $this->propertyId)->pluck('id', 'title');
    }

    public function addInventory()
    {
        $this->validate(
            ['description' => 'required',
                'photos.*' => 'nullable|image|mimes:gif,png,jpg,jpeg|max:3000',
                'propertyId' => 'required',
                'unitId' => Rule::requiredIf($this->inventoryForUnit),

            ], [
                'propertyId.required' => 'Please select a property',
                'unitId.required' => 'Select a property unit'
            ]
        );

        $propertyOrUnit = $this->inventoryForUnit ? PropertyUnit::find($this->unitId) : Property::find($this->propertyId);

        if (!$propertyOrUnit) {
            return $this->alert('warning', 'Warning', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Specified property or unit could not be located',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }

        DB::beginTransaction();

        try {

            $inventory = $propertyOrUnit->inventories()->create([
                'description' => $this->description,
            ]);

            if (isset($this->photos)) {
                foreach ($this->photos as $photo) {
                    $path = Storage::putFile('public/gallery', $photo);
                    $imageUrl = Storage::url($path);
                    $inventory->images()->create(
                        ['image' => $imageUrl]
                    );


                }
            }
            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error($exception);
            return $this->alert('error', 'Error', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
            ]);
        }
        $this->iteration++;

        session()->flash('success','Property inventory has been created');

        return redirect()->route('admin.inventory.index');



    }
}

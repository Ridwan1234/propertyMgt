<?php

namespace App\Http\Livewire\Admin\Inventory;

use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\InventoryGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $inventoryId;
    public $description;
    public $oldPhotos;
    public $photos;


    public function mount()
    {
        $inventory = Inventory::with('images')->findOrFail($this->inventoryId);
        $this->description = $inventory->description;
        $this->oldPhotos = $inventory->images;
    }

    public function render()
    {
        return view('livewire.admin.inventory.edit');
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

    public function deleteExistingImage($id)
    {
        $gallery = InventoryGallery::findOrFail($id);

        if (Storage::exists($gallery->image)) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        $this->alert('success', 'Success', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'An image has been removed from the inventory gallery',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
        $this->oldPhotos = InventoryGallery::where('inventory_id', $this->inventoryId)
            ->get();

    }

    public function removePhoto($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function updateInventory()
    {
        $this->validate(
            ['description' => 'required',
                'photos.*' => 'nullable|image|mimes:gif,png,jpg,jpeg|max:3000',
            ]
        );

        $inventory = Inventory::with('images')->findOrFail($this->inventoryId);

        DB::beginTransaction();

        try {

            $inventory->update(['description' => $this->description]);

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
        session()->flash('success','Property inventory has been updated');
        return redirect()->route('admin.inventory.show',$inventory->id);


    }
}

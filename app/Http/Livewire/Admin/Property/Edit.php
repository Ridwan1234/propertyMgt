<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Gallery;
use App\Models\Property;
use App\Models\PropertyUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $propertyId;

    public $title;
    public $rent;
    // public $deposit;
    public $propertyType;
    public $propertyArea;
    // public $commission = 0;
    public $description;
    public $street_address;
    public $city;
    public $zip;
    public $state;
    public $latitude;
    public $longitude;
    public $photos;
    public $oldPhotos;

    public $propertyNotes;
    public $propertyAge;
    // public $rooms;
    // public $bedrooms;
    // public $bathrooms;
    public $amenities = [];


    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'rent' => 'required|numeric',
        // 'deposit' => 'nullable|numeric',
        // 'commission' => 'required|numeric',
        'propertyArea' => 'nullable|numeric',
        'street_address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'longitude' => 'required',
        'latitude' => 'required',
        'photos.*' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5000'

    ];

    public function mount()
    {
        $property = Property::with('galleries')->findOrFail($this->propertyId);

        $this->title = $property->title;
        $this->rent = $property->rent;
        // $this->deposit = $property->deposit;
        $this->propertyType = $property->property_type;
        $this->propertyArea = $property->area;

        // $this->commission = $property->commission;
        $this->description = $property->description;
        $this->street_address = $property->address;
        $this->city = $property->city;
        $this->zip = $property->zip;
        $this->state = $property->state;
        $this->latitude = $property->latitude;
        $this->longitude = $property->longitude;

        $this->propertyNotes = $property->notes;
        $this->propertyAge = $property->age;
        // $this->rooms = $property->rooms;
        // $this->bedrooms = $property->bedrooms;
        // $this->bathrooms = $property->bathrooms;
        $this->amenities = $property->amenities;

        $this->oldPhotos = $property->galleries;


    }

    public function render()
    {
        return view('livewire.admin.property.edit');
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

    public function deleteExistingImage($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (Storage::exists($gallery->image)) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        $this->alert('success', 'Success', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'An image has been removed from the property gallery',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->oldPhotos = Gallery::where('gallerable_id', $this->unitId)
            ->where('gallerable_type', 'App\Models\Property')
            ->get();

    }

    public function updateProperty()
    {
        $this->validate();

        DB::beginTransaction();

        $property = Property::findOrFail($this->propertyId);
        try {
            $property->update([
                'title' => $this->title,
                'description' => $this->description,
                'property_type' => $this->propertyType,
                'area' => $this->propertyArea,
                'rent' => $this->rent,
                // 'deposit' => $this->deposit,
                // 'commission' => $this->commission,
                'address' => $this->street_address,
                'city' => $this->city,
                'state' => $this->state,
                'zip' => $this->zip,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'age' => $this->propertyAge,
                // 'rooms' => $this->rooms,
                // 'bedrooms' => $this->bedrooms,
                // 'bathrooms' => $this->bathrooms,
                'amenities' => $this->amenities,
                'notes' => $this->propertyNotes,
            ]);

            if (isset($this->photos)) {
                foreach ($this->photos as $photo) {
                    $path = Storage::putFile('public/gallery', $photo);
                    $imageUrl = Storage::url($path);
                    $property->galleries()->create(
                        ['image' => $imageUrl]
                    );


                }
            }


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);

            return $this->alert('error', 'Problem Updating Property', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        session()->flash('success', 'Property ' . $property->title . 'has been updated');

        return redirect()->route('admin.property.index');

    }

}

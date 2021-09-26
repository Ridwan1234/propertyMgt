<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $rent;
    public $propertyType;
    public $propertyArea;
    public $landlord;
    public $description;
    public $street_address;
    public $city;
    public $zip;
    public $state;
    public $latitude;
    public $longitude;
    public $manager;

    public $photos;

    public $propertyNotes;
    public $propertyAge;

    public $amenities=[];


    protected $rules=[
        'title'=>'required',
        'description'=>'required',
        'landlord'=>'required',
        'rent'=>'required|numeric',
        'propertyArea'=>'nullable|numeric',
        'street_address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zip'=>'required',
        'longitude'=>'required',
        'latitude'=>'required',
        'photos.*' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5000'
    ];


    public function render()
    {
        $landlords=User::whereRoleIs('landlord')->orderBy('fname')->pluck('id','fname');
        return view('livewire.admin.property.create',['landlords'=>$landlords]);
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


    public function createProperty()
    {
        $this->validate();


        DB::beginTransaction();

        try {
            $property = Property::create([
                'title' => $this->title,
                'description' => $this->description,
                'property_type' => $this->propertyType,
                'area' => $this->propertyArea,
                'rent' => $this->rent,
                'address' => $this->street_address,
                'city' => $this->city,
                'state' => $this->state,
                'zip' => $this->zip,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'age' => $this->propertyAge,
                'amenities' => $this->amenities,
                'notes' => $this->propertyNotes,
                'landlord_id' => $this->landlord,
               // 'manager_id' => $this->manager,
            ]);

            if (isset($this->photos)){
                foreach ($this->photos as $photo) {

                    $path = Storage::putFile('public/gallery', $photo);
                    $imageUrl = Storage::url($path);
                    $property->galleries()->create(
                        ['image' => $imageUrl]
                    );
                }
            }


            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception);

            return $this->alert('error', 'Problem Creating Property', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        session()->flash('success','New property with title '.$property->title .'has been added');

        return redirect()->route('admin.property.index');
    }
}

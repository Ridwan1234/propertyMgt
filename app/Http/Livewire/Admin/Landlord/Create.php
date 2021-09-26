<?php

namespace App\Http\Livewire\Admin\Landlord;

use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $address;
    public $identityNo;
    public $identityDocument;
    public $bankName;
    public $bankAccount;

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:users',
        'phone' => 'required',
        'address' => 'required',
        'identityNo' => 'required',
        'identityDocument' => 'nullable|file|mimes:jpg,pdf,png'

    ];


    public function render()
    {
        return view('livewire.admin.landlord.create');
    }

    public function UpdatedIdentityDocument()
    {
        $this->validate([
            'identityDocument' => 'nullable|file|mimes:jpg,pdf,png'
        ]);

    }


    public function createLandlord()
    {
        $this->validate();
        //random password
        $randomPassword = Str::random(8);
        $identityDocumentToStore = null;

        DB::beginTransaction();

        try {

            $user = User::create([
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->email,
                'password' => Hash::make($randomPassword),
            ]);

            $user->attachRole('landlord');

            //upload identity proof
            if (!empty($this->identityDocument)) {
                $path = Storage::putFile('public/documents', $this->identityDocument);
                $identityDocumentToStore = Storage::url($path);
            }
            //create landlord profile

            $user->landlordProfile()->create([
                'identity' => $this->identityNo,
                'identity_document' => $identityDocumentToStore,
                'phone' => $this->phone,
                'address' => $this->address,
                'bank_name' => $this->bankName,
                'bank_account' => $this->bankAccount,
            ]);

            $details = [
                'fname' => $user->fname,
                'lname' => $user->lname,
                'email' => $user->email,
                'password' => $randomPassword,
            ];

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);

            return $this->alert('error', 'Problem Registering Landlord', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        if (isset($details)){
            Mail::to($user->email)->send(new RegistrationMail($details));
        }

        session()->flash('success','New landlord with name '.$user->fname .'has been created');

        return redirect()->route('admin.landlord.index');
        //TODO SEND WELCOME EMAIL

    }
}

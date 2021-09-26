<?php

namespace App\Http\Livewire\Admin\Landlord;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $landlordId;

    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $address;
    public $identityNo;
    public $identityDocument;
    public $bankName;
    public $bankAccount;
    public $currentIdentityDocument;

    public function mount()
    {
        $landlord = User::with('landlordProfile')->findOrFail($this->landlordId);

        $this->fname = $landlord->fname;
        $this->lname = $landlord->lname;
        $this->email = $landlord->email;

        $this->phone = $landlord->landlordProfile->phone;
        $this->address = $landlord->landlordProfile->address;
        $this->bankName = $landlord->landlordProfile->bank_name;
        $this->bankAccount = $landlord->landlordProfile->bank_acc;
        $this->identityNo = $landlord->landlordProfile->identity;
        $this->bankAccount = $landlord->landlordProfile->bank_account;
        $this->currentIdentityDocument = $landlord->landlordProfile->identity_document;

    }

    public function render()
    {
        return view('livewire.admin.landlord.edit');
    }

    public function updateLandlord()
    {
        $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->landlordId,
            'phone' => 'required',
            'address' => 'required',
            'identityNo' => 'required',
            'identityDocument' => 'nullable|file|mimes:jpg,pdf,png'
        ]);

        $landlord = User::with('landlordProfile')->findOrFail($this->landlordId);

        try {
            $landlord->update([
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->email,
            ]);

            $landlord->landlordProfile()->update([
                'identity' => $this->identityNo,
                'phone' => $this->phone,
                'address' => $this->address,
                'bank_name' => $this->bankName,
                'bank_account' => $this->bankAccount,
            ]);

            //update identity document
            if (!empty($this->identityDocument)) {
                $path = Storage::putFile('public/documents', $this->identityDocument);
                $filenameToStore = Storage::url($path);

                //get value of existing proof
                $fileNameToDelete = $this->currentIdentityDocument;
                //update current one
                $landlord->landlordProfile()->update(['identity_document' => $filenameToStore]);
                //Delete if previous file exists
                if (!empty($fileNameToDelete) and Storage::exists($fileNameToDelete)) {

                    unlink(public_path($fileNameToDelete));
                }
            }
            DB::commit();


        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return $this->alert('error', 'Problem updating landlord', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $ex->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        session()->flash('success', 'Landlord details have been updated');
        return redirect()->route('admin.landlord.show', $landlord->id);
    }
}

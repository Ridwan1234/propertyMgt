<?php

namespace App\Http\Livewire\Admin\User;

use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;


class Create extends Component
{

    public $fname;
    public $lname;
    public $email;
    public $description;
    public $role;


    protected $rules = [
        'email' => 'required|unique:users,email',
        'fname' => 'required',
        'lname' => 'required',
        'role' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.user.create');
    }

    public function createUser()
    {
        $this->validate();
        $password = Str::random(8);
        DB::beginTransaction();

        try {

            $user = User::create([
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->email,
                'password' => Hash::make($password),
                'description' => empty($this->description) ? null : $this->description,
            ]);

            $user->attachRole($this->role);

            $details = [
                'fname' => $user->fname,
                'lname' => $user->lname,
                'email' => $user->email,
                'password' => $password,
            ];

            DB::commit();

        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollBack();

            return $this->alert('error', 'Problem creating user', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        if (isset($details)) {
            Mail::to($user->email)->send(new RegistrationMail($details));
        }

        session()->flash('success', 'New user has been created');

        return redirect()->route('admin.manage-user.index');
    }
}

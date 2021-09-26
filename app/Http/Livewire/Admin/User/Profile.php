<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{

    //Password properties
    public $password;
    public $current_password;
    public $password_confirmation;


    public function render()
    {
        return view('livewire.admin.user.profile');
    }

    public function updatePassword()
    {

        $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
        User::find(auth()->id())->update(['password' => Hash::make($this->password)]);

        $this->password = '';
        $this->password_confirmation = '';
        $this->current_password = '';
        session()->flash('updated-password', 'Your password has been updated.');
    }
}

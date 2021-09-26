<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;

class ManagePermissions extends Component
{

    public $userId;
    public $userName;
    public $userEmail;
    public $userRole;
    public $permissions = [];
    public $userPermissions = [];

    public function mount()
    {
        $user = User::findOrFail($this->userId);
        $this->userRole = $user->roles->first()->display_name;
        $this->userEmail = $user->email;
        $this->userName = $user->fname;
        $this->userPermissions = $user->permissions->pluck('fname');
        $this->permissions = Permission::all();
    }

    public function render()
    {

        return view('livewire.admin.user.manage-permissions');
    }

    public function updatePermissions()
    {
        $user = User::findOrFail($this->userId);
       // $permissionToStore = ['create-user','create-tenant','create-landlord'];

//        try {

        $user->detachPermissions();
        $user->attachPermissions($this->userPermissions);
//        }
//        catch (\Exception $exception){
//            dd($exception);
//        }
//

        $this->alert('success', 'User permissions have been updated', [
            'showCancelButton' => true,
            'showConfirmButton' => false,
        ]);
    }
}

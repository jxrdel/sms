<?php

namespace App\Livewire;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateUserModal extends Component
{
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $role;
    public $roles;
    public $selectedroles = [];
    
    public function mount()
    {
        $this->roles = Roles::all();

    }
    public function render()
    {
        return view('livewire.create-user-modal');
    }

    public function createUser(){

        // dd($this->selectedroles);
        
        $newuser = User::create([
            'Firstname' => $this->firstname,
            'Lastname' => $this->lastname,
            'Username' => $this->username,
            'Email' => $this->email,
            'LockedOut' => 0,
            'Attempts' => 0,
        ]);
        
        foreach ($this->selectedroles as $role) {
            DB::table('UserRoles')->insert([
                'RoleID' => $role['ID'],
                'UserID' => $newuser->UserID,
            ]);
        }
        
        $this->dispatch('close-create-modal');
        $this->dispatch('refresh-table');
        $this->dispatch('show-message', message: 'User added successfully');

    }

    public function addRole()
    {
        if ($this->role == null) {
            $message = "Please select a role";
            $this->dispatch('show-alert', message: $message);
        } elseif ($this->isDuplicate($this->role)){
            $message = "Role already selected";
            $this->dispatch('show-alert', message: $message);
        } else {
            $role = Roles::find($this->role);
            // dd($service);
            $this->selectedroles[] = ['ID' => $role->RoleID, 'Name' => $role->RoleName];
            $this->role = null;

        }
    }

    public function isDuplicate($id){ //Checks if service already exists
        
        foreach ($this->selectedroles as $role) {
            // Check if the 'ID' key has the search value
            if ($role['ID'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function removeRole($index){
        
        unset($this->selectedroles[$index]);

    }
}

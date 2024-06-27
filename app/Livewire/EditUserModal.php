<?php

namespace App\Livewire;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EditUserModal extends Component
{ 
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $user;
    public $email;
    public $lockedout;
    public $role;
    public $roles;
    public $selectedroles = [];
    public $deletedroles = [];

    public function render()
    {
        return view('livewire.edit-user-modal');
    }
    
    public function mount()
    {
        $this->roles = Roles::all();

    }
    
    #[On('show-edit-modal')]
    public function displayModal($id)
    {
        $this->id = $id;
        $this->deletedroles = [];
        $this->user = User::find($id);
        $this->username = $this->user->Username;
        $this->firstname = $this->user->Firstname;
        $this->lastname = $this->user->Lastname;
        $this->email = $this->user->Email;
        $this->lockedout = $this->user->LockedOut == 0 ? false : true;

        $selectedroles = DB::table('UserRoles')
            ->where('UserID', $this->user->UserID)
            ->join('Roles', 'UserRoles.RoleID', '=', 'Roles.RoleID')
            ->select('UserRoles.*', 'Roles.RoleName as RoleName')
            ->get();

        $this->selectedroles = $selectedroles->toArray();
        $this->selectedroles = json_decode(json_encode($this->selectedroles), true);
        
        $this->dispatch('display-edit-modal');
        // dd($supplier);

    }

    public function editUser(){

        // dd($this->deletedroles);
        
        User::where('UserID', $this->id)->update([
            'Firstname' => $this->firstname,
            'Lastname' => $this->lastname,
            'Username' => $this->username,
            'Email' => $this->email,
        ]);

        foreach ($this->deletedroles as $role) {
            if ($role['ID'] !== null) { //Items in the array with null ID were not in the database to begin with so they do not need to be deleted
                DB::table('UserRoles')
                    ->where('ID', $role['ID'])
                    ->delete();
            }
        }
        
        foreach ($this->selectedroles as $role) {
            if($role['ID'] == null){
                DB::table('UserRoles')->insert([
                    'RoleID' => $role['RoleID'],
                    'UserID' => $this->id,
                ]);
            }
        }
        
        $this->dispatch('close-edit-modal');
        $this->dispatch('refresh-table');
        $this->dispatch('show-message', message: 'User edited successfully');

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
            $this->selectedroles[] = ['ID' => null,'RoleID' => $role->RoleID, 'RoleName' => $role->RoleName];
            $this->role = null;

        }
    }

    public function isDuplicate($id){ //Checks if service already exists
        
        foreach ($this->selectedroles as $role) {
            // Check if the 'ID' key has the search value
            if ($role['RoleID'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function removeRole($index){
        
        $this->deletedroles[] = $this->selectedroles[$index];
        unset($this->selectedroles[$index]);

    }

    public function toggleAccountLock()
    {
        $newstate = $this->lockedout == true ? false : true;
        if ($newstate) {
            $this->user->lockAccount();
            $this->dispatch('show-message', message: 'Account locked successfully');
        } else {
            $this->user->unlockAccount();
            $this->dispatch('show-message', message: 'Account unlocked successfully');
        }
        $this->lockedout = $newstate;
    }
}

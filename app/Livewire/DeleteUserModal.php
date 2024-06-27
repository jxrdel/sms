<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public $id;

    public function render()
    {
        return view('livewire.delete-user-modal');
    }

    #[On('show-delete-modal')]
    public function displayModal($id)
    {
        $this->id = $id;

        $this->dispatch('display-delete-modal');
    }

    public function deleteRecord(){
        $record = User::find($this->id);
        // dd($record);
        $record->delete();

        $this->dispatch('close-delete-modal');
        $this->dispatch('show-message', message: 'User deleted successfully');
        $this->dispatch('refresh-table');
    }
}

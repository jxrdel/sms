<?php

namespace App\Livewire;

use App\Models\Subcategories;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSubcategoryModal extends Component
{
    public $id;
    public $subcategory;
    public $subcategoryname;
    public $oldname;

    public function render()
    {
        return view('livewire.edit-subcategory-modal');
    }

    public function editSubcategory(){

        // dd($this->subcategoryname);
        if(trim($this->subcategoryname) !== $this->oldname && Subcategories::nameExists($this->subcategoryname)){ //Displays error if the subcategory name is changed to a value that already exists 
            $this->addError('subcategoryname', 'Subcategory Name already exists');
        }else{

            Subcategories::where('SubCategoryID', $this->id)->update([
                'SubCategoryName' => $this->subcategoryname
            ]);
            
            $this->dispatch('close-edit-sub-modal');
            $this->dispatch('refresh-sub-table');
            $this->dispatch('show-message', message: 'Subcategory edited successfully');
        }
        
    }
    
    #[On('show-edit-sub-modal')]
    public function displayModal($id)
    {
        $this->id = $id;
        $subcategory = Subcategories::find($id);
        $this->oldname = $subcategory->SubCategoryName; //Stores value to see if it is changed
        $this->subcategoryname = $subcategory->SubCategoryName;
        
        $this->dispatch('display-edit-sub-modal');
    }
}

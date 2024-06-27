<?php

namespace App\Livewire;

use App\Models\Subcategories;
use Livewire\Component;

class CreateSubcategoryModal extends Component
{
    public $subcategoryname;

    public function render()
    {
        return view('livewire.create-subcategory-modal');
    }

    public function createSubcategory(){
        // dd($this->subcategoryname);
        if (Subcategories::nameExists(trim($this->subcategoryname))){
            $this->addError('subcategoryname', 'Subcategory Name already exists');
        }else{
            Subcategories::create([
                'SubCategoryName' => $this->subcategoryname,
            ]);
    
            $this->subcategoryname = null;
            
            $this->dispatch('close-createsub-modal');
            $this->dispatch('refresh-sub-table');
            $this->dispatch('show-message', message: 'Category added successfully');
        }
    }
}

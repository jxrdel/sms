<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateCategoryModal extends Component
{
    public $categoryname;
    public $subcategory;
    public $subcategories;
    public $selectedSC = [];

    public function render()
    {
        return view('livewire.create-category-modal');
    }

    public function createCategory(){
        // dd($this->selectedSC);
        if (Categories::nameExists(trim($this->categoryname))){
            $this->addError('categoryname', 'Category Name already exists');
        }else{
            Categories::create([
                'CategoryName' => $this->categoryname,
            ]);
    
            $this->categoryname = null;
            
            $this->dispatch('close-create-modal');
            $this->dispatch('refresh-table');
            $this->dispatch('show-message', message: 'Category added successfully');
        }
    }

    public function isDuplicate($category){ //Checks if supplier already exists
        
        foreach ($this->selectedSC as $categoryname) {
            // Check if the 'ID' key has the search value
            if ($categoryname['SubCategoryName'] == $category) {
                return true;
            }
        }
        return false;
    }
}

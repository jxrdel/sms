<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Subcategories;
use Livewire\Attributes\On;
use Livewire\Component;

class EditCategoryModal extends Component
{
    public $id;
    public $categoryname;
    public $oldname;
    public $subcategory;
    public $subcategories;
    public $selectedSC = [];
    public $deletedSC = [];

    public function render()
    {
        return view('livewire.edit-category-modal');
    }

    public function editCategory(){

        if (trim($this->categoryname) !== $this->oldname && Categories::nameExists(trim($this->categoryname))){ //Displays error if the category name is changed to a value that already exists 
            $this->addError('categoryname', 'Category Name already exists');
        }else{
            Categories::where('CategoryID', $this->id)->update([
                    'CategoryName' => $this->categoryname
                ]);
                
                $this->dispatch('close-edit-modal');
                $this->dispatch('refresh-table');
                $this->dispatch('show-message', message: 'Category edited successfully');
        }
        
    }
    
    #[On('show-edit-modal')]
    public function displayModal($id)
    {
        $this->id = $id;
        $this->deletedSC = [];
        $category = Categories::find($id);
        $this->oldname = $category->CategoryName;
        $this->categoryname = $category->CategoryName;

        // $selectedSC = Subcategories::where('MainCategoryID', $id)->get();

        // $this->selectedSC = $selectedSC->toArray();
        // $this->selectedSC = json_decode(json_encode($this->selectedSC), true);
        // dd($this->selectedSC);
        
        $this->dispatch('display-edit-modal');
    }


}

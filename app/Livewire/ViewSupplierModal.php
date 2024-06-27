<?php

namespace App\Livewire;

use App\Models\Contacts;
use App\Models\Suppliers;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewSupplierModal extends Component
{
    public $id;
    public $services;
    public $service;
    public $primarycontactname;
    public $primarycontactno;
    public $secondarycontactname;
    public $secondarycontactno;
    public $email;
    public $deletedservices;
    public $suppliername;
    public $categoryname;
    public $subcategoryname;
    public $address;
    public $phoneno;
    public $notes;
    public $isactive;
    public $selectedcategories = [];

    public function render()
    {
        return view('livewire.view-supplier-modal');
    }

    #[On('show-view-supplier-modal')]
    public function displaySupplierModal($id)
    {
        $this->id = $id;
        $this->deletedservices = [];
        $supplier = Suppliers::where('SupplierID', $id)
        ->first();
        
        $this->suppliername = $supplier->SupplierName;
        $this->address = $supplier->Address;
        $this->email = $supplier->Email;
        $this->primarycontactname = $supplier->PrimaryContactName;
        $this->primarycontactno = $supplier->PrimaryContactNo;
        $this->secondarycontactname = $supplier->SecondaryContactName;
        $this->secondarycontactno = $supplier->SecondaryContactNo;
        $this->notes = $supplier->Notes;
        $this->phoneno = $supplier->PhoneNo;
        $this->isactive = $supplier->IsActive == 1 ? true : false;

        $selectedcategories = DB::table('SupplierCategories')
            ->where('SupplierID', $supplier->SupplierID)
            ->join('Category', 'SupplierCategories.MainCategoryID', '=', 'Category.CategoryID')
            ->join('SubCategory', 'SupplierCategories.SubCategoryID', '=', 'SubCategory.SubCategoryID')
            ->select('SupplierCategories.SupplierCategoryID as SupplierCategoryID', 'Category.CategoryID as MainCategoryID', 'Category.CategoryName as MainCategoryName', 'Subcategory.SubCategoryID as SubCategoryID', 'Subcategory.SubCategoryName as SubCategoryName')
            ->get();

        $this->selectedcategories = $selectedcategories->toArray();
        $this->selectedcategories = json_decode(json_encode($this->selectedcategories), true);
        
        $this->dispatch('display-view-supplier-modal');

    }
}

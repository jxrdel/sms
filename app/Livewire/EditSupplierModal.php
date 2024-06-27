<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\Services;
use App\Models\Subcategories;
use App\Models\Suppliers;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSupplierModal extends Component
{
    public $id;
    public $services;
    public $service;
    public $email;
    public $primarycontactname;
    public $primarycontactno;
    public $primaryemail;
    public $secondarycontactname;
    public $secondarycontactno;
    public $secondaryemail;
    public $notes;
    public $deletedcategories;
    public $suppliername;
    public $address;
    public $phoneno;
    public $isactive;
    public $isindividual;
    public $idnumber;
    public $range;
    public $contacts;
    public $category;
    public $subcategory = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
    public $categories;
    public $subcategories;
    public $selectedcategories = [];

    public function render()
    {
        $this->categories = Categories::orderBy('CategoryName')->get();
        $this->subcategories = Subcategories::orderBy('SubCategoryName')->get();
        return view('livewire.edit-supplier-modal');
    }

    public function mount(){
        
        $this->services = Services::all();
        $this->contacts = Contacts::all();
        $this->categories = Categories::orderBy('CategoryName')->get();
        $this->subcategories = Subcategories::orderBy('SubCategoryName')->get();
    }
    public function editSupplier(){
        // dd($this->deletedcategories);
        
        Suppliers::where('SupplierID', $this->id)->update([
            'SupplierName' => $this->suppliername,
            'Email' => $this->email,
            'Address' => $this->address,
            'PhoneNo' => $this->phoneno,
            'Range' => $this->range,
            'PrimaryContactName' => $this->primarycontactname,
            'PrimaryContactNo' => $this->primarycontactno,
            'PrimaryContactEmail' => $this->primaryemail,
            'SecondaryContactName' => $this->secondarycontactname,
            'SecondaryContactNo' => $this->secondarycontactno,
            'SecondaryContactEmail' => $this->secondaryemail,
            'Notes' => $this->notes,
            'IsActive' => $this->isactive  == true ? 1 : 0,
        ]);

        foreach ($this->deletedcategories as $category) {
            if ( array_key_exists('SupplierCategoryID', $category) && $category['SupplierCategoryID']  !== null) { //Items in the array with null ID were not in the database to begin with so they do not need to be deleted
                DB::table('SupplierCategories')
                    ->where('SupplierCategoryID', $category['SupplierCategoryID'])
                    ->delete();
            }
        }
        
        foreach ($this->selectedcategories as $category) {
            

            if (array_key_exists('NewMainCategory', $category)){ //Checks if the selected category is new. Only new selections would have the array key NewMainCategory 
                $maincategoryID = $category['MainCategoryID'];
                $subcategoryID = $category['SubCategoryID'];
    
                if($category['NewMainCategory']){//If a new category is added
                    if (Categories::nameExists($category['MainCategoryName'])){
                        $existingrecord = Categories::where('CategoryName', $category['MainCategoryName'])->first();
                        $maincategoryID = $existingrecord->CategoryID;
                    }else{
                        $newmaincategory = Categories::create([
                            'CategoryName' => $category['MainCategoryName'],
                            ]
                        );
                        $maincategoryID = $newmaincategory->CategoryID;
                    }
                }
    
                if($category['NewSubCategory']){//If a new subcategory is added
                    $newsubcategory = Subcategories::create([
                        'SubCategoryName' => $category['SubCategoryName'],
                        ]
                    );
                    $subcategoryID = $newsubcategory->SubCategoryID;
                }
    
                DB::table('SupplierCategories')->insert([
                    'SupplierID' => $this->id,
                    'MainCategoryID' => $maincategoryID,
                    'SubCategoryID' => $subcategoryID,
                ]);
            }
        }
        
        $this->categories = Categories::all();
        $this->subcategories = Subcategories::all();
        $this->dispatch('close-edit-modal');
        $this->dispatch('refresh-table');
        $this->dispatch('show-message', message: 'Supplier edited successfully');
    }
    #[On('show-edit-modal')]
    public function displayModal($id)
    {
        $this->categories = Categories::orderBy('CategoryName')->get();
        $this->subcategories = Subcategories::orderBy('SubCategoryName')->get();
        $this->id = $id;
        $this->deletedcategories = [];
        $supplier = Suppliers::find($id);
        $this->suppliername = $supplier->SupplierName;
        $this->address = $supplier->Address;
        $this->phoneno = $supplier->PhoneNo;
        $this->email = $supplier->Email;
        $this->primarycontactname = $supplier->PrimaryContactName;
        $this->primarycontactno = $supplier->PrimaryContactNo;
        $this->secondarycontactname = $supplier->SecondaryContactName;
        $this->secondarycontactno = $supplier->SecondaryContactNo;
        $this->notes = $supplier->Notes;
        $this->range = $supplier->Range;
        $this->idnumber = $supplier->IDNumber;
        $this->isindividual = $supplier->IsIndividual == 1 ? true : false;
        $this->isactive = $supplier->IsActive == 1 ? true : false;

        $selectedcategories = DB::table('SupplierCategories')
            ->where('SupplierID', $supplier->SupplierID)
            ->join('Category', 'SupplierCategories.MainCategoryID', '=', 'Category.CategoryID')
            ->join('SubCategory', 'SupplierCategories.SubCategoryID', '=', 'SubCategory.SubCategoryID')
            ->select('SupplierCategories.SupplierCategoryID as SupplierCategoryID', 'Category.CategoryID as MainCategoryID', 'Category.CategoryName as MainCategoryName', 'Subcategory.SubCategoryID as SubCategoryID', 'Subcategory.SubCategoryName as SubCategoryName')
            ->get();

        $this->selectedcategories = $selectedcategories->toArray();
        $this->selectedcategories = json_decode(json_encode($this->selectedcategories), true);
        
        $this->dispatch('display-edit-modal');

    }
    

    public function addCategory()
    {
        // dd($this->category);
        if ($this->category == null) {
            $message = "Please select a category";
            $this->dispatch('show-alert', message: $message);
        } elseif ($this->isDuplicate($this->category["id"], $this->subcategory["id"])){
            $message = "Category and subcategory already selected";
            $this->dispatch('show-alert', message: $message);
        } else {
            
            $this->selectedcategories[] = [
                'MainCategoryID' => $this->category["id"], 'MainCategoryName' => $this->category["text"], 'NewMainCategory' => $this->category["newcategory"], 
                'SubCategoryID' => $this->subcategory["id"], 'SubCategoryName' => $this->subcategory["text"], 'NewSubCategory' => $this->subcategory["newsubcategory"]
            ];
           
            $this->category = null;
            $this->dispatch('reset-category-edit');

            $this->subcategory = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
            $this->dispatch('reset-subcategory-edit');
        }
        // dd($this->selectedcategories);
    }

    public function isDuplicate($maincategory, $subcategory){ //category already exists
        
        foreach ($this->selectedcategories as $category) {
            // Check if the 'ID' key has the search value
            if ($category['MainCategoryID'] == $maincategory) {
                if ($category['SubCategoryID'] == $subcategory){
                    return true;
                }
            }
        }
        return false;
    }

    public function removeCategory($index){
        $this->deletedcategories[] = $this->selectedcategories[$index];
        unset($this->selectedcategories[$index]);
    }


    #[On('set-category-edit')]
    public function setCategory($data){
        if($data["id"] == null){
            $this->category = null;
        }else if ($data["id"] == $data["text"]){
            $data["newcategory"] = true;
            $this->category = $data;
        }else{
            $data["newcategory"] = false;
            $this->category = $data;
        }
    }

    #[On('set-subcategory-edit')]
    public function setSubcategory($data){
        if($data["id"] == null){ //Sets value to null when the select value is cleared or when the blank option is selected
            $this->subcategory = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
        }else if ($data["id"] == $data["text"]){ //Indicates whether the value selected was a newly created subcategory
            $data["newsubcategory"] = true;
            $this->subcategory = $data;
        }else{
            $data["newsubcategory"] = false;
            $this->subcategory = $data;
        }
    }
}

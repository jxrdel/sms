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

class CreateSupplierModal extends Component
{
    public $suppliername;
    public $email;
    public $primarycontactname;
    public $primarycontactno;
    public $secondarycontactname;
    public $secondarycontactno;
    public $primaryemail;
    public $secondaryemail;
    public $notes;
    public $phoneno;
    public $address;
    public $idnumber;
    public $range;
    public $isindividual = "false";

    
    public $category;
    public $subcategory  = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
    public $contacts;
    public $categories;
    public $subcategories;
    public $selectedcategories = [];

    public function render()
    {
        return view('livewire.create-supplier-modal');
    }

    public function mount(){
        
        $this->contacts = Contacts::all();
        $this->categories = Categories::orderBy('CategoryName')->get();
        $this->subcategories = Subcategories::orderBy('SubCategoryName')->get();
    }

    public function createSupplier(){

        // dd($this->isindividual);
        if ($this->selectedcategories == null) {
            $message = "Please select at least one category";
            $this->dispatch('show-alert', message: $message);
        }else{
        
            $newsupplier = Suppliers::create([
                'SupplierName' => $this->suppliername,
                'Email' => $this->email,
                'Address' => $this->address,
                'PhoneNo' => $this->phoneno,
                'PrimaryContactName' => $this->primarycontactname,
                'PrimaryContactNo' => $this->primarycontactno,
                'PrimaryContactEmail' => $this->primaryemail,
                'SecondaryContactName' => $this->secondarycontactname,
                'SecondaryContactNo' => $this->secondarycontactno,
                'SecondaryContactEmail' => $this->secondaryemail,
                'Notes' => $this->notes,
                'IDNumber' => $this->idnumber,
                'Range' => $this->range,
                'IsIndividual' => $this->isindividual == "true" ? 1 : 0,
                'IsActive' => 1,
            ]);
            
            foreach ($this->selectedcategories as $category) {
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
                    'SupplierID' => $newsupplier->SupplierID,
                    'MainCategoryID' => $maincategoryID,
                    'SubCategoryID' => $subcategoryID,
                ]);
            }
            $this->suppliername = null;
            $this->email = null;
            $this->primarycontactname = null;
            $this->primarycontactno = null;
            $this->secondarycontactname = null;
            $this->secondarycontactno = null;
            $this->notes = null;
            $this->address = null;
            $this->selectedcategories = [];
            $this->idnumber = null;
            $this->isindividual = "false";
            $this->categories = Categories::all();
            $this->subcategories = Subcategories::all();
            
            $this->dispatch('close-create-modal');
            $this->dispatch('reset-category');
            $this->dispatch('reset-subcategory');
            $this->dispatch('refresh-table');
            $this->dispatch('show-message', message: 'Supplier added successfully');
        }
    }

    public function addCategory()
    {
        // dd($this->category);
        if ($this->category == null) {
            $message = "Please select a category and subcategory";
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
            $this->dispatch('reset-category');

            $this->subcategory = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
            $this->dispatch('reset-subcategory');
        }
        // dd($this->selectedcategories);
    }

    public function isDuplicate($maincategory, $subcategory){ //check if category already exists
        
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
        
        unset($this->selectedcategories[$index]);

    }

    #[On('set-category')]
    public function setCategory($data){
        if($data["id"] == null){ //Sets value to null when the select value is cleared or when the blank option is selected
            $this->category = null;
        }else if ($data["id"] == $data["text"]){ //Indicates whether the value selected was a newly created subcategory
            $data["newcategory"] = true;
            $this->category = $data;
        }else{
            $data["newcategory"] = false;
            $this->category = $data;
        }
    }

    #[On('set-subcategory')]
    public function setSubcategory($data){
        if($data["id"] == null){
            $this->subcategory = ['id' => 5, 'text' => "N/A", 'newsubcategory' => false];
        }else if ($data["id"] == $data["text"]){
            $data["newsubcategory"] = true;
            $this->subcategory = $data;
        }else{
            $data["newsubcategory"] = false;
            $this->subcategory = $data;
        }
    }

    // public function updatedCategory(){
    //     // dd($this->category);
    //     $this->subcategories = Subcategories::where('MainCategoryID', $this->category)->get();
    //     $this->subcategory = null;
    // }
}

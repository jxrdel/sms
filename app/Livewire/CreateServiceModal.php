<?php

namespace App\Livewire;

use App\Models\Services;
use App\Models\Suppliers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateServiceModal extends Component
{
    public $servicename;
    public $suppliers;
    public $supplier;
    public $selectedsuppliers = [];

    public function render()
    {
        return view('livewire.create-service-modal');
    }

    public function mount(){
        
        $this->suppliers = Suppliers::all();
    }

    public function createService(){

        // dd($this->servicename);
        
        $newservice = Services::create([
            'ServiceName' => $this->servicename,
        ]);
        
        foreach ($this->selectedsuppliers as $supplier) {
            DB::table('SupplierServices')->insert([
                'ServiceID' => $newservice->ServiceID,
                'SupplierID' => $supplier['ID'],
            ]);
        }
        $this->servicename = null;
        $this->supplier = null;
        $this->selectedsuppliers = [];
        
        $this->dispatch('close-create-modal');
        $this->dispatch('refresh-table');
        $this->dispatch('show-message', message: 'Service added successfully');
    }

    public function addSupplier()
    {
        if ($this->supplier == null) {
            $message = "Please select a supplier";
            $this->dispatch('show-alert', message: $message);
        } elseif ($this->isDuplicate($this->supplier)){
            $message = "Supplier already selected";
            $this->dispatch('show-alert', message: $message);
        } else {
            $supplier = Suppliers::find($this->supplier);
            // dd($supplier);
            $this->selectedsuppliers[] = ['ID' => $supplier->SupplierID, 'Name' => $supplier->SupplierName];
            $this->supplier = null;

        }
    }

    public function isDuplicate($id){ //Checks if supplier already exists
        
        foreach ($this->selectedsuppliers as $supplier) {
            // Check if the 'ID' key has the search value
            if ($supplier['ID'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function removeSupplier($index){
        
        unset($this->selectedsuppliers[$index]);

    }
}

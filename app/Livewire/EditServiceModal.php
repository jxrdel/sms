<?php

namespace App\Livewire;

use App\Models\Services;
use App\Models\Suppliers;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EditServiceModal extends Component
{
    public $id;
    public $servicename;
    public $suppliers;
    public $supplier;
    public $selectedsuppliers = [];
    public $deletedsuppliers = [];

    public function render()
    {
        return view('livewire.edit-service-modal');
    }

    public function mount(){
        
        $this->suppliers = Suppliers::all();
    }

    public function editService(){

        // dd($this->selectedsuppliers);
        
        Services::where('ServiceID', $this->id)->update([
            'ServiceName' => $this->servicename
        ]);

        
        
        foreach ($this->selectedsuppliers as $supplier) {
            if($supplier['ID'] == null){
                DB::table('SupplierServices')->insert([
                    'ServiceID' => $this->id,
                    'SupplierID' => $supplier['SupplierID'],
                ]);
            }
        }

        foreach ($this->deletedsuppliers as $supplier) {
            if ($supplier['ID'] !== null) { //Items in the array with null ID were not in the database to begin with so they do not need to be deleted
                DB::table('SupplierServices')
                    ->where('ID', $supplier['ID'])
                    ->delete();
            }
        }
        
        $this->dispatch('close-edit-modal');
        $this->dispatch('refresh-table');
        $this->dispatch('show-message', message: 'Service edited successfully');
        
    }

    #[On('show-edit-modal')]
    public function displayModal($id)
    {
        $this->id = $id;
        $this->deletedsuppliers = [];
        $service = Services::find($id);
        $this->servicename = $service->ServiceName;

        $selectedsuppliers = DB::table('SupplierServices')
            ->where('ServiceID', $service->ServiceID)
            ->join('Suppliers', 'SupplierServices.SupplierID', '=', 'Suppliers.SupplierID')
            ->select('SupplierServices.*', 'Suppliers.SupplierName as SupplierName')
            ->get();

        $this->selectedsuppliers = $selectedsuppliers->toArray();
        $this->selectedsuppliers = json_decode(json_encode($this->selectedsuppliers), true);
        // dd($this->selectedsuppliers);
        
        $this->dispatch('display-edit-modal');
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
            $this->selectedsuppliers[] = ['ID' => null, 'SupplierID' => $supplier->SupplierID, 'ServiceID' => null, 'SupplierName' => $supplier->SupplierName];
            $this->supplier = null;

        }
    }

    public function isDuplicate($id){ //Checks if supplier already exists
        
        foreach ($this->selectedsuppliers as $supplier) {
            // Check if the 'ID' key has the search value
            if ($supplier['SupplierID'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function removeSupplier($index){
        
        $this->deletedsuppliers[] = $this->selectedsuppliers[$index];
        unset($this->selectedsuppliers[$index]);

    }
}

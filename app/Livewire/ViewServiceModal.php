<?php

namespace App\Livewire;

use App\Models\Services;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewServiceModal extends Component
{
    public $id;
    public $servicename;
    public $selectedsuppliers = [];

    public function render()
    {
        return view('livewire.view-service-modal');
    }
    #[On('show-view-modal')]
    public function displayModal($id)
    {
        $this->id = $id;
        $service = Services::find($id);
        $this->servicename = $service->ServiceName;

        $selectedsuppliers = DB::table('SupplierServices')
            ->where('ServiceID', $service->ServiceID)
            ->join('Suppliers', 'SupplierServices.SupplierID', '=', 'Suppliers.SupplierID')
            ->select('SupplierServices.*', 'Suppliers.SupplierName as SupplierName')
            ->get();

        $this->selectedsuppliers = $selectedsuppliers->toArray();
        $this->selectedsuppliers = json_decode(json_encode($this->selectedsuppliers), true);
        
        $this->dispatch('display-view-modal');
    }
}

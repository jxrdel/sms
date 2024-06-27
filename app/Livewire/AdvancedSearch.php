<?php

namespace App\Livewire;

use App\Models\Suppliers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AdvancedSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $results;
    public $search;

    #[On('render-search')]
    public function render()
    {
        if(!$this->search){
            $suppliers = DB::table('SupplierCategoryView')
            ->select('SupplierID', 'SupplierName', 'CategoryName', 'SubCategoryName')
            ->orderBy('SupplierName')
            ->get();
        }else{
            $suppliers = DB::table('SupplierCategoryView')
            ->select('SupplierID', 'SupplierName', 'CategoryName', 'SubCategoryName')
            ->where('SupplierName' , 'like', '%' . trim($this->search) . '%')
            ->orWhere('CategoryName' , 'like', '%' . trim($this->search) . '%')
            ->orWhere('SubCategoryName' , 'like', '%' . trim($this->search) . '%')
            ->orderBy('SupplierName')
            ->get();
        }
        

        // Group records by SupplierName
        $groupedSuppliers = [];
        foreach ($suppliers as $record) {
            $supplierName = $record->SupplierName;

            // Group by SupplierName
            if (!isset($groupedSuppliers[$supplierName])) {
                $groupedSuppliers[$supplierName] = [
                    'id' => $record->SupplierID,
                    'categories' => [],
                ];
            }

            // Add record to the grouped array
            $groupedSuppliers[$supplierName]['categories'][] = [
                'CategoryName' => $record->CategoryName,
                'SubCategoryName' => $record->SubCategoryName,
            ];
        }

        // Paginate the grouped records
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Change as needed
        $pagedData = array_slice($groupedSuppliers, ($page - 1) * $perPage, $perPage);
        $groupedSuppliers = new LengthAwarePaginator($pagedData, count($groupedSuppliers), $perPage);

        // dump($groupedSuppliers);
        return view('livewire.advanced-search', compact('groupedSuppliers'));
    }

    public function clearInput(){
        $this->search = null;
    }
}

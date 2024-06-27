<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createServiceModalLabel" style="color: black; text-align:center">Create Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="createService" action="">
            <div class="modal-body" style="color: black">
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">Service Name: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control" wire:model="servicename" type="text" style="width: 70%;color:black;margin-left:50px" required>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="margin-top: 40px">
                    <p style="text-align: center"><strong>Select the suppliers that provide this service</strong></p>
                    <div class="col" style="text-align: center;padding-bottom:20px">
                    
                            <select wire:model="supplier" class="form-select" style="display: inline;width: 300px;">
                                <option value="">Select a Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->SupplierID }}">{{ $supplier->SupplierName}}</option>
                                @endforeach
                            </select>
                            &nbsp;
                            <button wire:click.prevent="addSupplier()" class="btn btn-dark" style="width: 9rem"><i class="fas fa-plus"></i> &nbsp;Add Supplier</button>
                    </div>
                </div>

                <div class="row" style="padding-left: 30px;padding-right:30px">
                    <table id="supplierstable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:600px">Supplier</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($this->selectedsuppliers as $index => $supplier)
                                <tr>
                                    <td>{{$supplier['Name']}}</td>
                                    <td style="text-align: center"><button wire:click="removeSupplier({{$index}})" type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center">No suppliers selected</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer" style="align-items: center">
                <div style="margin:auto">
                    <button class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

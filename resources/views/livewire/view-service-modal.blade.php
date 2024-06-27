<!-- Modal -->
<div wire:ignore.self class="modal fade" id="viewServiceModal" tabindex="-1" aria-labelledby="viewServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="viewServiceModalLabel" style="color: black; text-align:center">View Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="viewService" action="">
            <div class="modal-body" style="color: black">
                
                <div class="row" style="padding:20px">

                    <div class="col" style="text-align: center">
                        <strong style="font-size: 1.8rem">{{$this->servicename}}</strong>
                    </div>

                </div>

                <div class="row" style="padding-left: 30px;padding-right:30px">
                    <table id="viewsupplierstable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:600px">Supplier</th>
                                <th style="text-align: center">View</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($this->selectedsuppliers as $index => $supplier)
                                <tr>
                                    <td><a href="#" style="color: black"  onclick="showViewSupplier({{$supplier['SupplierID']}})" >{{$supplier['SupplierName']}}</a></td>
                                    <td style="text-align: center"><a href="#" onclick="showViewSupplier({{$supplier['SupplierID']}})" class="btn btn-outline-primary"><i class="bi bi-eye-fill"></i></a></td>
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

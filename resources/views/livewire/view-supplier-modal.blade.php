<!-- Modal -->
<div wire:ignore.self class="modal fade" id="viewSupplierModal" tabindex="-1" aria-labelledby="viewSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="viewSupplierModalLabel" style="color: black; text-align:center">View Supplier</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="viewSupplier" action="">
            <div class="modal-body" style="color: black">
                
                <div class="row" >

                    <div class="col" style="display: flex;">
                        <label style="margin:auto;font-size: 1.8rem" for="title"><strong>{{$this->suppliername}}</strong></label>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Address: </strong>&nbsp;{{$this->address}}</label>
                    </div>

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Phone Number: </strong>&nbsp;{{$this->phoneno}}</label>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Email: </strong>&nbsp;{{$this->email}}</label>
                    </div>

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Active: </strong>&nbsp;<i class="{{ $this->isactive == 1 ? 'bi bi-check-lg' : 'bi bi-x-lg' }}"></i></label></label>
                    </div>

                </div>
                
                <div class="row" style="margin-top:20px">

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Primary Contact: </strong>&nbsp;{{$this->primarycontactname}} - {{$this->primarycontactno}}</label>
                    </div>

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Secondary Contact: </strong>&nbsp;{{$this->secondarycontactname}} - {{$this->secondarycontactno}}</label>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;">
                        <label style="margin:auto" for="title"><strong>Notes: </strong>&nbsp;{{$this->notes}}</label>
                    </div>

                    <div class="col" style="display: flex;">
                    </div>

                </div>


                <div class="row" style="padding-left: 30px;padding-right:30px;margin-top:20px">
                    <table id="supplierstable" class="table table-bordered table-hover">
                        <thead style="background-color: rgba(59, 59, 59, 0.63);color:white">
                            <tr>
                                <th style="width:500px">Main Category</th>
                                <th style="width:500px">Subcategory</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($this->selectedcategories as $index => $category)
                                <tr>
                                    <td><strong>{{$category['MainCategoryName']}}</strong></td>
                                    <td><strong>{{$category['SubCategoryName']}}</strong></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center">No categories associated with this supplier</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer" style="align-items: center">
                <div style="margin:auto">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

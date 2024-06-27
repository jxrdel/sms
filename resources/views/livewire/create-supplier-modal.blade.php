<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createSupplierModal" tabindex="-1" aria-labelledby="createSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createSupplierModalLabel" style="color: black; text-align:center">Create Supplier</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="createSupplier" action="">
            <div class="modal-body" style="color: black">
                <div class="row">
                    <div class="row" style="margin-top:10px">

                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Entity Type: &nbsp;</label>
                            </div>
                            <div class="col">
                                <div style="margin-left: 50px">
                                    <input wire:model.live="isindividual" value="false" type="radio" class="btn-check" name="options-outlined" id="perpetualradio" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="perpetualradio">Company</label>&nbsp;&nbsp;
            
                                    <input wire:model.live="isindividual" value="true" type="radio" class="btn-check" name="options-outlined" id="enddateradio" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="enddateradio">Individual</label>
                                </div>
                            </div>
                        </div>
    
                    </div>

                    <div class="row" style="margin-top:10px">

                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Supplier Name: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="suppliername" type="text" style="width: 90%;color:black;margin-left:50px" required>
                            </div>
                        </div>
    
                    </div>

                    @if ($this->isindividual == "true")
                        <div class="row" style="margin-top:10px">

                            <div class="col" style="display: flex;">
                                <div class="col-3">
                                    <label style="margin-top:5px;" for="title">Identification Number: &nbsp;</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" wire:model="idnumber" type="text" style="width: 90%;color:black;margin-left:50px" @required($this->isindividual == "true")>
                                </div>
                            </div>
        
                        </div>
                    @endif
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Phone Number: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="phoneno" type="text" style="width: 90%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Email: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="email" style="width: 90%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Address: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="address" type="text" style="width: 90%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Notes: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="notes" type="text" style="width: 90%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Range: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="range" type="text" style="width: 90%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                
                    <div class="row" style="margin-top:10px">

                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Primary Contact: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="primarycontactname" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>

                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Phone #: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="primarycontactno" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>

                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Email: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="primaryemail" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Secondary Contact: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="secondarycontactname" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Phone #: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="secondarycontactno" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                        <div class="col" style="display: flex;">
                            <div class="col-3">
                                <label style="margin-top:5px;" for="title">Email: &nbsp;</label>
                            </div>

                            <div class="col">
                                <input class="form-control" wire:model="secondaryemail" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                            
                        </div>
    
                    </div>
            </div>

            <div class="row" style="padding: 20px;text-align:center">
                <p style="text-align: center"><strong>Select the associated categories for this supplier</strong></p>
                <div wire:ignore class="col">
                    <select id="category-select" class="form-select" style="display: inline;width: 30%;margin-right:5px">
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->CategoryID }}">{{ $category->CategoryName}}</option>
                        @endforeach
                    </select>

                    <select id="subcategory-select" class="form-select" style="display: inline;width: 30%;margin-right:5px">
                        <option value="">Select a Subcategory</option>
                        @foreach ($subcategories as $category)
                            <option value="{{ $category->SubCategoryID }}">{{ $category->SubCategoryName}}</option>
                        @endforeach
                    </select>


                        &nbsp;
                        <button wire:click.prevent="addCategory()" class="btn btn-dark" style="width: 3rem"><i class="fas fa-plus"></i></button>
                </div>
            </div>

                <div class="row" style="padding-left: 30px;padding-right:30px">
                    <table id="supplierstable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:500px">Main Category</th>
                                <th style="width:500px">Subcategory</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($this->selectedcategories as $index => $category)
                                <tr>
                                    <td>{{$category['MainCategoryName']}}</td>
                                    <td>{{$category['SubCategoryName']}}</td>
                                    <td style="text-align: center"><button wire:click="removeCategory({{$index}})" type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center">No services selected</td>
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

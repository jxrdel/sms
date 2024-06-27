<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createContactModal" tabindex="-1" aria-labelledby="createContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createContactModalLabel" style="color: black; text-align:center">Create Con</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="createContact" action="">
            <div class="modal-body" style="color: black">
                <div class="row">
                <div class="col">
                    <div class="row" style="margin-top:10px">

                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Supplier Name: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="suppliername" type="text" style="width: 80%;color:black;margin-left:50px" required>
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Email: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="email" type="email" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Address: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="address" type="text" style="width: 80%;color:black;margin-left:50px" required>
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Phone Number: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="phoneno" type="text" style="width: 80%;color:black;margin-left:50px" required>
                            </div>
                        </div>
    
                    </div>
                </div>
                
                <div class="col">
                    <div class="row" style="margin-top:10px">

                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Primary Contact: &nbsp;</label>
                            </div>
                            <div class="col">
                                {{-- <input class="form-control" wire:model="primarycontact" type="text" style="width: 80%;color:black;margin-left:50px" required> --}}
                    
                                <select wire:model="primarycontact" class="form-select" style="width: 80%;color:black;margin-left:50px" required>
                                    <option value="">Select a Contact</option>
                                    @foreach ($contacts as $contact)
                                        <option value="{{ $contact->ContactID }}">{{ $contact->ContactName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Secondary Contact: &nbsp;</label>
                            </div>
                            <div class="col">
                    
                                <select wire:model="secondarycontact" class="form-select" style="width: 80%;color:black;margin-left:50px">
                                    <option value="">Select a Contact</option>
                                    @foreach ($contacts as $contact)
                                        <option value="{{ $contact->ContactID }}">{{ $contact->ContactName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="row" style="margin-top:10px">
    
                        <div class="col" style="display: flex;">
                            <div class="col-4">
                                <label style="margin-top:5px;" for="title">Notes: &nbsp;</label>
                            </div>
                            <div class="col">
                                <input class="form-control" wire:model="notes" type="text" style="width: 80%;color:black;margin-left:50px">
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>

                <div class="row" style="margin-top: 40px">
                    <p style="text-align: center"><strong>Select the services that this supplier provides</strong></p>
                    <div class="col" style="text-align: center;padding-bottom:20px">
                    
                            <select wire:model="service" class="form-select" style="display: inline;width: 300px;">
                                <option value="">Select a Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->ServiceID }}">{{ $service->ServiceName}}</option>
                                @endforeach
                            </select>
                            &nbsp;
                            <button wire:click.prevent="addService()" class="btn btn-dark" style="width: 9rem"><i class="fas fa-plus"></i> &nbsp;Add Service</button>
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

                            @forelse ($this->selectedservices as $index => $service)
                                <tr>
                                    <td>{{$service['Name']}}</td>
                                    <td style="text-align: center"><button wire:click="removeService({{$index}})" type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center">No services selected</td>
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

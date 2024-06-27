<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editUserModalLabel" style="color: black; text-align:center">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="editUser" action="">
            <div class="modal-body" style="color: black">
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">First Name: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control" wire:model="firstname" type="text" style="width: 70%;color:black;margin-left:50px" required>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">Last Name: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control" wire:model="lastname" type="text" style="width: 70%;color:black;margin-left:50px" required>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">Username: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control" wire:model="username" type="text" style="width: 70%;color:black;margin-left:50px" required>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">Email: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control" wire:model="email" type="email" style="width: 70%;color:black;margin-left:50px" required>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="margin-top:20px">

                    <button wire:click.prevent="toggleAccountLock()" class="btn btn-dark" style="width: 12rem;margin:auto"> 
                        @if ($this->lockedout)
                            <i class="fas fa-lock-open"></i> Unlock Account
                        @else 
                            <i class="fas fa-lock"></i> Lock Account 
                        @endif
                    </button>

                </div>

                <div class="row" style="margin-top: 40px">
                    <div class="col" style="text-align: center;padding-bottom:20px">
                    
                            <select wire:model="role" id="companyID" class="form-select" style="display: inline;width: 300px;">
                                <option value="">Select a Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->RoleID }}">{{ $role->RoleName}}</option>
                                @endforeach
                            </select>
                            <button wire:click.prevent="addRole()" class="btn btn-primary" style="width: 10rem"><i class="fas fa-plus"></i> Add Role</button>
                    </div>
                </div>

                <div class="row" style="padding-left: 30px;padding-right:30px">
                    <table id="rolestable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:600px">Role</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->selectedroles as $index => $role)
                                <tr>
                                    <td>{{$role['RoleName']}}</td>
                                    <td style="text-align: center"><button wire:click="removeRole({{$index}})" type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center">No roles selected</td>
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

@extends('layout')

@section('title')
  <title>SMS | Users</title>
@endsection
@section('content')
    
@livewire('create-user-modal')
@livewire('edit-user-modal')
  <h2 style="text-align: center"><i class="bi bi-person-rolodex"></i> &nbsp; Contacts</h2>
    <div class="card">
        <div class="card-body">
        
        
          <div class="row" style="padding: 10px">
            <a type="button" data-bs-toggle="modal" data-bs-target="#createUserModal" class="btn btn-dark btn-icon-split" style="width: 12rem; margin:auto">
                <span class="icon text-white-50">
                    <i class="fas fa-user-plus" style="color: white"></i>
                </span>
                <span class="text"  style="width: 200px"> &nbsp; Create Contact</span>
            </a> 
        </div>
        <table id="userTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        
        window.addEventListener('show-message', event => {
                    
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton" : true,
                    }
                    toastr.success(event.detail.message,'' , {timeOut:3000});
                })

        window.addEventListener('show-alert', event => {
                var message = event.detail.message;

                // Display an alert with the received message
                alert(message);
        })

        $(document).ready(function() {
            $('#userTable').DataTable({
                "pageLength": 10,
                // order: [[1, 'asc']],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('getcontacts') }}",
                    "type": "GET"
                },
                "columns": [
                    {
                        data: 'ContactName',
                        name: 'ContactName'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
                    },
                    {
                        data: 'PhoneNo',
                        name: 'PhoneNo'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                                    return '<p style="text-align:center; height:10px"><a href="#" onclick="showEdit(' + data.UserID + ')">Edit</a> | <a href="#" onclick="showDelete(' + data.UserID + ')">Delete</a></p>';
                        }
                    },
                ]
            });
        });


        window.addEventListener('refresh-table', event => {
            $('#userTable').DataTable().ajax.reload();
        })
        window.addEventListener('close-create-modal', event => {
            $('#createUserModal').modal('hide');
        })
        
        function showEdit(id) {
                Livewire.dispatch('show-edit-modal', { id: id });
            }

        window.addEventListener('display-edit-modal', event => {
            $('#editUserModal').modal('show');
        })

        window.addEventListener('close-edit-modal', event => {
            $('#editUserModal').modal('hide');
        })
    </script>
@endsection
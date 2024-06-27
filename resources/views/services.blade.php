@extends('layout')

@section('title')
  <title>SMS | Services</title>
@endsection

@section('content')
    
    @livewire('view-service-modal')
    @livewire('create-service-modal')
    @livewire('edit-service-modal')
    @livewire('view-supplier-modal')
  <h2 style="text-align: center"><i class="fas fa-tools"></i> &nbsp; Services</h2>
    <div class="card">
        <div class="card-body">
            
            <div class="row" style="padding: 10px">
                <a type="button" data-bs-toggle="modal" data-bs-target="#createServiceModal" class="btn btn-dark btn-icon-split" style="width: 12rem; margin:auto">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus" style="color: white"></i>
                    </span>
                    <span class="text"  style="width: 200px"> &nbsp; Create Service</span>
                </a> 
            </div>
            
            <table id="serviceTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Service Name</th>
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
      
      $(document).ready(function() {
          $('#serviceTable').DataTable({
              "pageLength": 10,
              // order: [[1, 'asc']],
              "processing": true,
              "serverSide": true,
              "ajax": {
                  "url": "{{ route('getservices') }}",
                  "type": "GET"
              },
              "columns": [
                  {
                      data: 'ServiceName',
                      name: 'ServiceName'
                  },
                  {
                      data: null,
                      orderable: false,
                      searchable: false,
                      render: function(data, type, row) {
                                  return '<p style="text-align:center; height:10px"><a href="#" onclick="showView(' + data.ServiceID + ')">View</a> | <a href="#" onclick="showEdit(' + data.ServiceID + ')">Edit</a> | <a href="#" onclick="showDelete(' + data.ServiceID + ')">Delete</a></p>';
                      }
                  },
              ]
          });
      });


    window.addEventListener('refresh-table', event => {
        $('#serviceTable').DataTable().ajax.reload();
    })
    
        
    function showView(id) {
            Livewire.dispatch('show-view-modal', { id: id });
            // $('#viewsupplierstable').DataTable();
        }
    
        
    function showViewSupplier(id) {
            Livewire.dispatch('show-view-supplier-modal', { id: id });
            // $('#viewsupplierstable').DataTable();
        }

    window.addEventListener('display-view-supplier-modal', event => {
        $('#viewSupplierModal').modal('show');
    })
    
        
    function showEdit(id) {
            Livewire.dispatch('show-edit-modal', { id: id });
        }

    window.addEventListener('display-view-modal', event => {
        $('#viewServiceModal').modal('show');
    })

    window.addEventListener('display-edit-modal', event => {
        $('#editServiceModal').modal('show');
    })
      

    window.addEventListener('show-message', event => {
            
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.success(event.detail.message,'' , {timeOut:3000});
        })

    window.addEventListener('close-create-modal', event => {
        $('#createServiceModal').modal('hide');
    })

    window.addEventListener('close-edit-modal', event => {
        $('#editServiceModal').modal('hide');
    })

    window.addEventListener('show-alert', event => {
            var message = event.detail.message;

            // Display an alert with the received message
            alert(message);
    })
    </script>
@endsection
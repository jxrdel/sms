@extends('layout')

@section('title')
  <title>SMS | Suppliers</title>
@endsection

@section('styles')
    <style>
        #searchcard .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            padding: 14px 80px 2px 30px;
        }

        #searchcard .card:hover {
            transform: scale(1.002);
            box-shadow: 0 5px 10px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        #searchcard .card h3 {
            font-weight: 600;
        }

        #searchcard .card {
            min-height: 100px;
        }

        @media(max-width: 990px) {
            #searchcard .card {
                margin: 20px;
            }
        }

    </style>
@endsection

@section('content')
    
    @include('access-denied')
    @livewire('view-supplier-modal')
    @livewire('create-supplier-modal')
    @livewire('edit-supplier-modal')
  <h2 style="text-align: center"><i class="fas fa-truck"></i> &nbsp; Suppliers</h2>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="true">Supplier List</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="search-tab" data-bs-toggle="tab" data-bs-target="#search-tab-pane" type="button" role="tab" aria-controls="search-tab-pane" aria-selected="false">Advanced Search</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
            
            
                <div class="row" style="padding: 10px">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#createSupplierModal" class="btn btn-dark btn-icon-split" style="width: 12rem; margin:auto">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus" style="color: white"></i>
                        </span>
                        <span class="text"  style="width: 200px"> &nbsp; Create Supplier</span>
                    </a> 
                </div>
    
                <div class="col" style="text-align:right;padding-bottom: 20px">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                      
                        <input type="radio" class="btn-check" name="btnradio" id="btnactiveradio" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="btnactiveradio">Active</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnallradio" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnallradio">All</label>
                      
                        <input type="radio" class="btn-check" name="btnradio" id="btnindividualradio" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnindividualradio">Individuals</label>
                      
                        <input type="radio" class="btn-check" name="btnradio" id="btnretiredradio" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnretiredradio">Retired</label>
                    </div>
                </div>
                
            
            <table id="supplierTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th style="text-align: center">Phone No</th>
                        <th style="text-align: center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="search-tab-pane" role="tabpanel" aria-labelledby="search-tab" tabindex="0">
        @livewire('advanced-search')
    </div>
  </div>

@endsection

@section('scripts')
    <script>
      $(document).ready(function() {
          $('#supplierTable').DataTable({
              "pageLength": 10,
              // order: [[1, 'asc']],
              "processing": true,
              "serverSide": true,
              "ajax": {
                  "url": "{{ route('getactivesuppliers') }}",
                  "type": "GET"
              },
              "columns": [
                  {
                      data: 'SupplierName',
                      name: 'SupplierName'
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
                                  return '<p style="text-align:center; height:10px"><a href="#" onclick="showView(' + data.SupplierID + ')">View</a> | <a href="#" onclick="showEdit(' + data.SupplierID + ')">Edit</a></p>';
                      }
                  },
              ]
          });
      });

    window.addEventListener('refresh-table', event => {
        $('#supplierTable').DataTable().ajax.reload();
        Livewire.dispatch('render-search');
    })
      
    $(document).ready(function() {
    $('.btn-check').change(function() { //Table Filter
        var selectedOption = $("input[name='btnradio']:checked").attr('id');
        switch(selectedOption) {
            case 'btnallradio':
                $('#supplierTable').DataTable().ajax.url('{{ route("getsuppliers") }}').load();
                break;
            case 'btnactiveradio':
                $('#supplierTable').DataTable().ajax.url('{{ route("getactivesuppliers") }}').load();
                break;
            case 'btnindividualradio':
                $('#supplierTable').DataTable().ajax.url('{{ route("getindividuals") }}').load();
                break;
            case 'btnretiredradio':
                $('#supplierTable').DataTable().ajax.url('{{ route("getinactivesuppliers") }}').load();
                break;
        }
    });
});
      window.addEventListener('show-message', event => {
                
                toastr.options = {
                    "progressBar" : true,
                    "closeButton" : true,
                }
                toastr.success(event.detail.message,'' , {timeOut:3000});
            })

        window.addEventListener('close-create-modal', event => {
            $('#createSupplierModal').modal('hide');
        })

        window.addEventListener('close-edit-modal', event => {
            $('#editSupplierModal').modal('hide');
        })

        window.addEventListener('show-alert', event => {
                var message = event.detail.message;

                // Display an alert with the received message
                alert(message);
        })

        function showView(id) {
                Livewire.dispatch('show-view-supplier-modal', { id: id });
            }

        function showEdit(id) {
            var hasPermission = "{{auth()->user()->hasRole('Admin') ?? ''}}";
            if (hasPermission == 1){
                Livewire.dispatch('show-edit-modal', { id: id });
            } else {
                $('#deniedModal').modal('show');
            }
            }

        window.addEventListener('display-view-supplier-modal', event => {
            $('#viewSupplierModal').modal('show');
        })

        window.addEventListener('display-edit-modal', event => {
            $('#editSupplierModal').modal('show');
        })

        // Select2 Elements for Create Supplier Modal
        $('#category-select').select2({
            dropdownParent: $('#createSupplierModal'),
            tags: true
        });
        $('#category-select').on('select2:select', function (e) {
            var data = e.params.data;
            Livewire.dispatch('set-category', { data: data });
        });

        window.addEventListener('reset-category', event => {
            $('#category-select').val(null).trigger('change');
        });
        
        $('#subcategory-select').select2({
            dropdownParent: $('#createSupplierModal'),
            tags: true
        });
        $('#subcategory-select').on('select2:select', function (e) {
            var data = e.params.data;
            Livewire.dispatch('set-subcategory', { data: data });
        });

        window.addEventListener('reset-subcategory', event => {
            $('#subcategory-select').val(null).trigger('change');
        });

        // Select2 Elements for Edit Supplier Modal
        $('#category-select-edit').select2({
            dropdownParent: $('#editSupplierModal'),
            tags: true
        });
        $('#category-select-edit').on('select2:select', function (e) {
            var data = e.params.data;
            // console.log(data);
            Livewire.dispatch('set-category-edit', { data: data });
        });

        window.addEventListener('reset-category-edit', event => {
            $('#category-select-edit').val(null).trigger('change');
        });
        
        $('#subcategory-select-edit').select2({
            dropdownParent: $('#editSupplierModal'),
            tags: true
        });
        $('#subcategory-select-edit').on('select2:select', function (e) {
            var data = e.params.data;
            Livewire.dispatch('set-subcategory-edit', { data: data });
        });

        window.addEventListener('reset-subcategory-edit', event => {
            $('#subcategory-select-edit').val(null).trigger('change');
        });
    </script>
@endsection
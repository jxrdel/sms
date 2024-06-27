@extends('layout')

@section('title')
  <title>SMS | Categories</title>
@endsection

{{-- @section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection --}}

@section('content')
    
    @livewire('create-category-modal')
    @livewire('edit-category-modal')
    @livewire('view-supplier-modal')
    
    @livewire('create-subcategory-modal')
    @livewire('edit-subcategory-modal')

  <h2 style="text-align: center"><i class="bi bi-journal-text"></i> &nbsp; Categories</h2>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="true">Main Categories</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="search-tab" data-bs-toggle="tab" data-bs-target="#search-tab-pane" type="button" role="tab" aria-controls="search-tab-pane" aria-selected="false">Subcategories</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
        <div class="card">
          <div class="card-body">
              
              <div class="row" style="padding: 10px">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#createCategoryModal" class="btn btn-dark btn-icon-split" style="width: 12rem; margin:auto">
                      <span class="icon text-white-50">
                          <i class="fas fa-plus" style="color: white"></i>
                      </span>
                      <span class="text"  style="width: 200px"> &nbsp; Create Category</span>
                  </a> 
              </div>
              
              <table id="categoryTable" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Category Name</th>
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
        <div class="card">
          <div class="card-body">
              
              <div class="row" style="padding: 10px">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#createSubcategoryModal" class="btn btn-dark btn-icon-split" style="width: 12rem; margin:auto">
                      <span class="icon text-white-50">
                          <i class="fas fa-plus" style="color: white"></i>
                      </span>
                      <span class="text"  style="width: 200px"> &nbsp; Create Subcategory</span>
                  </a> 
              </div>
              
              <table id="subcategoryTable" class="table table-bordered table-hover" style="width: 100%">
                  <thead>
                      <tr>
                          <th>Subcategory Name</th>
                          <th style="text-align: center">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
      
          </div>
      </div>
    </div>
  </div>


@endsection

@section('scripts')
    <script>
      
      $(document).ready(function() {
          $('#categoryTable').DataTable({
              "pageLength": 10,
              // order: [[1, 'asc']],
              "processing": true,
              "serverSide": true,
              "ajax": {
                  "url": "{{ route('getcategories') }}",
                  "type": "GET"
              },
              "columns": [
                  {
                      data: 'CategoryName',
                      name: 'CategoryName'
                  },
                  {
                      data: null,
                      orderable: false,
                      searchable: false,
                      render: function(data, type, row) {
                                  return '<p style="text-align:center; height:10px"><a href="#" onclick="showEdit(' + data.CategoryID + ')">Edit</a></p>';
                      }
                  },
              ]
          });
      });


      
      $(document).ready(function() {
          $('#subcategoryTable').DataTable({
              "pageLength": 10,
              // order: [[1, 'asc']],
              "processing": true,
              "serverSide": true,
              "ajax": {
                  "url": "{{ route('getsubcategories') }}",
                  "type": "GET"
              },
              "columns": [
                  {
                      data: 'SubCategoryName',
                      name: 'SubCategoryName'
                  },
                  {
                      data: null,
                      orderable: false,
                      searchable: false,
                      render: function(data, type, row) {
                                  return '<p style="text-align:center; height:10px"><a href="#" onclick="showEditSub(' + data.SubCategoryID + ')">Edit</a></p>';
                      }
                  },
              ]
          });
      });

    window.addEventListener('refresh-table', event => {
        $('#categoryTable').DataTable().ajax.reload();
    })

    window.addEventListener('refresh-sub-table', event => {
        $('#subcategoryTable').DataTable().ajax.reload();
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
        $('#editCategoryModal').modal('show');
    })
      

    window.addEventListener('show-message', event => {
            
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.success(event.detail.message,'' , {timeOut:3000});
        })

    window.addEventListener('close-create-modal', event => {
        $('#createCategoryModal').modal('hide');
    })

    window.addEventListener('close-edit-modal', event => {
        $('#editCategoryModal').modal('hide');
    })

    window.addEventListener('show-alert', event => {
            var message = event.detail.message;

            // Display an alert with the received message
            alert(message);
    })

    
    window.addEventListener('close-createsub-modal', event => {
        $('#createSubcategoryModal').modal('hide');
    })

    window.addEventListener('close-edit-sub-modal', event => {
        $('#editSubcategoryModal').modal('hide');
    })

    window.addEventListener('display-edit-sub-modal', event => {
        $('#editSubcategoryModal').modal('show');
    })    

    function showEditSub(id) {
            Livewire.dispatch('show-edit-sub-modal', { id: id });
        }
    </script>
@endsection
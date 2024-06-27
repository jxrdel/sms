@extends('layout')

@section('title')
  <title>SMS | Search</title>
@endsection

@section('styles')
    <style>
        .card{
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            padding: 14px 80px 2px 30px;
        }

        .card:hover{
            transform: scale(1.002);
        box-shadow: 0 5px 10px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .card h3{
        font-weight: 600;
        }

        .card{
            min-height: 100px;
        }

        @media(max-width: 990px){
        .card{
            margin: 20px;
        }
        } 
    </style>
@endsection

@section('content')
    
    @livewire('view-supplier-modal')
    @livewire('edit-supplier-modal')
    <h2 style="text-align: center"><i class="ti ti-search"></i> &nbsp; Search</h2>

    @livewire('advanced-search')
@endsection

@section('scripts')
    <script>
        

    window.addEventListener('refresh-table', event => {
        Livewire.dispatch('render-search');
    })

        function showView(id) {
                Livewire.dispatch('show-view-supplier-modal', { id: id });
            }

        window.addEventListener('display-view-supplier-modal', event => {
            $('#viewSupplierModal').modal('show');
        })

        function showEdit(id) {
                Livewire.dispatch('show-edit-modal', { id: id });
            }

        window.addEventListener('display-edit-modal', event => {
            $('#editSupplierModal').modal('show');
        })
        
        window.addEventListener('show-message', event => {
                
                toastr.options = {
                    "progressBar" : true,
                    "closeButton" : true,
                }
                toastr.success(event.detail.message,'' , {timeOut:3000});
            })
            

        window.addEventListener('close-edit-modal', event => {
            $('#editSupplierModal').modal('hide');
        })
    </script>
@endsection
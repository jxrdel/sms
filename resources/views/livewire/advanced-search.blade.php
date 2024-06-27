<div id="searchcard">

    <div  style="width: 85%;position: relative;display: inline-block;margin-left:100px;margin-bottom:20px;margin-top:30px">
		<input style="color: black" wire:model.live.debounce.300ms="search" autocomplete="off" id="searchBox" type="text" class="form-control p-2 bg-primary-border border border-2 border-primary" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" autofocus>
		<a style="position: absolute;right: 60px;transform: translateY(-150%);" onmouseover="this.style.cursor='pointer'" wire:click="clearInput"><i class="bi bi-x-lg"></i></a>
		<button class="btn btn-primary" style="border-top-left-radius: 1px;border-bottom-left-radius: 1px;position: absolute;right: 0px;transform: translateY(-100%);height:40px;cursor:default"><i class="bi bi-search" disabled></i></button>
    </div>

   @forelse ($groupedSuppliers as $supplierName => $categories)
    
   <div class="card">
       <div class="row">
           <div class="col-9"><h3>{{$supplierName}}</h3>
               <div>
                   <ul>
                       @foreach ($categories['categories'] as $category)
                           <li><strong>Category: </strong> {{ $category['CategoryName'] }} | <strong>Sub Category: </strong>{{ $category['SubCategoryName'] }}</li>
                       @endforeach
                   </ul>
               </div>
           </div>
           <div class="col" style="text-align: end">
               <a href="#" style="min-width: 80px" onclick="showView({{$categories['id']}})" class="btn btn-outline-primary">View</a></h3>
               <a href="#" style="min-width: 80px" onclick="showEdit({{$categories['id']}})" class="btn btn-outline-dark">Edit</a></h3>
           </div>
           
       </div>
   </div>
   @empty
       <p style="margin: auto">No records found</p>
   @endforelse

    {{ $groupedSuppliers->links() }}
</div>

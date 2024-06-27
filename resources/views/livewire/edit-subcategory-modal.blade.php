<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editSubcategoryModalLabel" style="color: black; text-align:center">Create Subcategory</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="editSubcategory" action="">
            <div class="modal-body" style="color: black">
                
                <div class="row" style="margin-top:10px">

                    <div class="col" style="display: flex;margin-left: 80px">
                        <div class="col-3">
                            <label style="margin-top:5px;" for="title">Subcategory Name: &nbsp;</label>
                        </div>
                        <div class="col">
                            <input class="form-control @error('subcategoryname')is-invalid @enderror" wire:model="subcategoryname" type="text" style="width: 70%;color:black;margin-left:50px" required>
                            <div style="color:red;margin-left:50px">@error('subcategoryname') {{ $message }} @enderror</div>
                        </div>
                    </div>

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

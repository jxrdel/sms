
<div class="card-body">
    <h2 style="text-align: center"><i class="ti ti-file-dollar"></i>&nbsp; <strong>Supplier Management System</strong></h2>
    <div style="color:red; text-align: center">@error('error') {{ $message }} @enderror</div>
    
    <form wire:submit.prevent="login">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control @error('username')is-invalid @enderror" id="username" wire:model="username" required autocomplete="off" placeholder="firstname.lastname" autofocus>
        <div style="color:red; text-align: center">@error('username') {{ $message }} @enderror</div>
      </div>
      <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control @error('password')is-invalid @enderror" id="exampleInputPassword1" wire:model="password" placeholder="Password" required>
        <div style="color:red; text-align: center">@error('password') {{ $message }} @enderror</div>
      </div>
      <br>
      <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
      
    </form>
  </div>
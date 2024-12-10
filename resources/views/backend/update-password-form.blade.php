<form method="post" action="{{ route('password.update') }}" >
    @csrf
    @method('put')
    
      <div class="row">

    <div class="col-md-4">

      <div class="form-input ">
        <x-text-input id="current_password" name="current_password" type="password"/>
        <label class="lh-1 text-16 text-light-1">Old Password</label>
      </div>
      <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />

    </div>

      {{-- new password --}}

    <div class="col-md-4">

      <div class="form-input ">
        <x-text-input id="password" name="password" type="password"/>
        <label class="lh-1 text-16 text-light-1">New Password</label>
      </div>
      <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />

    </div>
    {{-- confirm password  --}}

    <div class="col-md-4">

      <div class="form-input ">
        <x-text-input id="password_confirmation" name="password_confirmation" type="password"/>
        <label class="lh-1 text-16 text-light-1">Confirm Password</label>
      </div>
      <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />

    </div>
  </div>

    
  <div class="d-inline-block pt-30">

    <button  class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
      Update <div class="icon-arrow-top-right ml-15"></div>
    </button>

  </div>
  </form>
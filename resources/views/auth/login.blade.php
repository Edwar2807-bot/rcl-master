@extends('layouts.app')

@section('content')

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form  method="POST" action="{{ route('login') }}" id="login">
            @csrf
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
          </div>
          <br>
          <!-- Email input -->
          <div class="col-md-6">

        </div>
          {{--  --}}
          <div class="form-outline mb-4">
            <input id="usuario" type="text" class=" form-control-lg form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus placeholder="Your Email Or Username">
            @if ($errors->has('usuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span>
            @endif
            <label class="form-label" for="form3Example3">Usuario</label>        
        </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input id="password" type="password" class="form-control-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label class="form-label" for="form3Example4">Password</label>
        </div>
          {{--  --}}

          {{--  --}}
          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Remember me
            </label>
            </div>
          </div>
          {{--  --}}
          <div class="text-center text-lg-start mt-4 pt-2">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg"  style="padding-left: 2.5rem; padding-right: 2.5rem;">
                    Login
                </button>                
                @if (Route::has('password.request'))
                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a> -->
                @endif
            </div>
        </div>
          {{--  --}}
        </form>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 202. All rights reserved.
    </div>
  </div>
</section>

@endsection
@section('scripts')
<script type="text/javascript">
$('#usuario').focus();
$( "#login" ).submit(function( event ) {

});

</script>
@endsection
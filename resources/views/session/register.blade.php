


@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome</h3>
                  <span class="text-sm">Electric Bill Management System</span>
                  <hr>
                  <h6 class="my-0">Sign Up</h6>
                  <div class="alert alert-danger text-white text-sm mb-0 mt-2" id="error" style="display: none;"></div>
                </div>
                <div class="card-body">
                  <form id="sign-up">
                    @csrf
                    <div class="">
                      <label for="">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}" required>
                      @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="">
                      <label for="">Address</label>
                      <input type="text" class="form-control" placeholder="Address" name="location" id="location" value="{{ old('location') }}" required>
                      @error('location')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="">
                      <label for="">Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" value="{{ old('phone') }}" required>
                      @error('phone')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="">
                      <label for="">Account Number</label>
                      <input type="text" class="form-control" placeholder="Account Number" name="account_number" id="acount-number" value="{{ old('account_number') }}" required>
                      @error('account_number')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="">
                      <label for="">Email</label>
                      <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}" required>
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="">Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon" value="{{ old('password') }}" required>
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                      <p class="text-xs text-danger my-1" id="password-length"></p>
                      <p class="text-xs text-danger my-1" id="password-validation"></p>
                    </div>
                    <div class="form-check form-check-info text-left">
                      <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                      @error('agreement')
                        <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="login" class="text-dark font-weight-bolder">Sign in</a></p>
                  </form>
                </div>
                
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved14.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection

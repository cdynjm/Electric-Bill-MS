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
                  <h6 class="my-0">Sign In</h6>
                  <div class="alert alert-danger text-white text-sm mb-0 mt-2" id="error" style="display: none;"></div>
                </div>
                <div class="card-body">
                  <form id="sign-in" class="mb-3">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required>
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
        
                    </div>
                    
                    <div class="text-center">
                      <button type="submit" class="btn bg-dark w-100 text-white mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                  <div class="text-center mb-3">
                    <a href="{{ route('forgot.password') }}" class="text-sm fw-bold text-dark">Forgot Password?</a>
                  </div>

                  <div id="g_id_onload"
                      data-client_id="{{ env('GOOGLE_CLIENT_ID') }}"
                      data-callback="onSignIn">
                  </div>

                  <div class="g_id_signin form-control" data-type="standard"></div>
                    
                  <div id="loginmsg"></div>
                  
                  <script src="https://accounts.google.com/gsi/client" async defer></script>
                  <script>
                    function decodeJwtResponse(token) {
                        let base64Url = token.split('.')[1];
                        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                        }).join(''));
                        return JSON.parse(jsonPayload);
                    }
                
                    window.onSignIn = googleUser => {
                        var user = decodeJwtResponse(googleUser.credential);
                
                        if (user) {
                            $.ajax({
                                url: '/sign-in-with-google',
                                method: 'POST',
                                data: { 
                                    name: user.name,
                                    email: user.email 
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                beforeSend:function(){
                                    SweetAlert.fire({
                                        position: 'center',
                                        icon: 'info',
                                        title: 'Verifying Google Account...',
                                        allowOutsideClick: true,
                                        showConfirmButton: false
                                    });
                                },
                                success: function(response) {
                                    if (response.error == true) {
                                        Swal.close();
                                        $("#error").show(50);
                                        $("#error").text(response.Message);
                                    } else {
                                        window.location.href="/dashboard";
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                }
                            });
                        } else {
                            $("#loginmsg").html("<div class='alert alert-danger'>You have no institutional account registered.</div>");
                        }
                    }
                </script>

                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
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

@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  @include('layouts.navbars.auth.nav', ['title' => 'Create Bill'])
  <div class="container-fluid py-4 px-5">
    <div class="row">
        <div class="text-center text-danger">
          You are not verified. Before continue, please check your email to validate your account.        
        </div>
    </div>
    </div>
  @include('layouts.footers.auth.footer')
  </div>
</main>
@endsection
@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  @include('layouts.navbars.auth.nav', ['title' => 'PayMaya'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card border-0" style="background-image: linear-gradient(to bottom right, rgb(47, 194, 47), white);">
                    <div class="card-header" style="background-image: linear-gradient(to bottom right, rgb(51, 212, 51), rgb(135, 221, 135));">
                        
                    </div>
                    <div class="text-center m-0" style="font-size: 40px; position: absolute; top: 8%; left: 48%; ">
                        <i class="bi bi-circle-fill" style="color: rgb(81, 188, 49)"></i>
                    </div>
                    <div class="text-center m-0" style="font-size: 40px; position: absolute; top: 8%; left: 48%; ">
                        <i class="bi bi-check-circle text-white"></i>
                    </div>
                    
                    <div class="card-body bg-white m-3 p-0">
                        <div class="text-center m-0">
                            <h5 class="fw-bolder mt-4">Send Money Successful!</h5>
                        
                            <hr class="mx-2 mt-5">
                            <div class="row px-4">
                                <div class="col-9 text-start">
                                    <p class="mb-0 text-sm fw-bold opacity-7">Recipient</p>
                                    <h6 class="mt-0 fw-bolder">
                                        <img src="{{ asset('assets/851-8518764_paymaya.png') }}" alt="" style="width: 20px; height: auto;"> 
                                        0906 670 7887</h6>
                                </div>
                                <div class="col-3 text-end">
                                    <img src="{{ asset('assets/man-user-circle-icon.webp') }}" alt="" style="width: 50px; height: auto;"> 
                                </div>
                            </div>
                            <hr class="mx-2 mt-2">
                            <div class="row px-4">
                                <div class="col-6 text-start">
                                    <p class="mb-0 text-sm fw-bold opacity-7">Amount</p>
                                    <h5 class="mb-0" style="color: orange">PHP {{ number_format(Session::get('amount'), 2) }}</h5>
                                    <p class="mb-0 text-xs mt-0 fw-bold opacity-7">Transfer Fee: PHP 0.00</p>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="me-2 fw-bolder text-sm mt-0 opacity-7 border"><i class="fas fa-check"></i> COMPLETED</p>
                                </div>
                            </div>
                            <hr class="mx-2 mt-2">

                            <div class="text-start mx-4">
                                <h6 class="fw-bolder">Transaction Details</h6>
                                <p class="opacity-7 text-sm">Reference ID: <span class="text-dark opacity-10 fw-bolder">DE1783322D60</span></p>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
  </main>
  @endsection
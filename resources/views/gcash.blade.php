@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  @include('layouts.navbars.auth.nav', ['title' => 'GCash'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card border-0" style="background: blue">
                    <div class="card-header" style="background: blue">
                        
                    </div>
                    <div class="text-center m-0" style="font-size: 40px; position: absolute; top: 8%; left: 48%; ">
                        <i class="bi bi-circle-fill" style="color: rgb(38, 38, 147)"></i>
                    </div>
                    <div class="text-center m-0" style="font-size: 40px; position: absolute; top: 8%; left: 48%; ">
                        <i class="bi bi-check-circle text-white"></i>
                    </div>
                    
                    <div class="card-body bg-white m-3 p-0">
                        <div class="text-center m-0">
                            <h5 class="fw-bolder mt-4" style="color: blue;">ELECTRIC BILL MS</h5>
                            <p><i class="far fa-address-book me-1"></i> 
                                <span class="fw-bold">EBMS</span>
                                <span class="fw-bolder rounded-pill px-2" style="color: blue; background: rgb(214, 214, 255); padding: 2px;">0997 783 5413</span>
                            </p>
                            <p class="text-sm opacity-7 text-dark">
                                Sent via GCash
                            </p>
                            <hr class="mx-2">
                            <div class="row px-4">
                                <div class="col-6 text-start">
                                    <p class="ms-2 text-sm fw-bold" style="color: darkblue">Amount</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="me-2 text-sm fw-bold" style="color: darkblue">{{ number_format(Session::get('amount'), 2) }}</p>
                                </div>
                            </div>
                            <hr class="mx-2 mt-0">
                            <div class="row px-4">
                                <div class="col-4 text-start">
                                    <p class="ms-2 text-sm fw-bold" style="color: darkblue">Total Amount Sent</p>
                                </div>
                                <div class="col-8 text-end">
                                    <p class="me-2 fw-bolder mt-0" style="color: darkblue; font-size: 25px;">₱ {{ number_format(Session::get('amount'), 2) }}</p>
                                </div>
                            </div>
                            <div class="row m-0 rounded w-100" style="background: rgb(217, 217, 247); padding: 10px;">
                                <div class="text-xxs">
                                    <span>Ref No. <span class="fw-bolder">7568 231 989904</span></span>
                                </div>
                                <div class="text-xxs">{{ date('M d, Y g:i A', strtotime(Session::get('date'))) }}</div>
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
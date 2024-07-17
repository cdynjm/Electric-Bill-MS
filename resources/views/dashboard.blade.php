@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  @include('layouts.navbars.auth.nav', ['title' => 'Dashboard'])
  <div class="container-fluid py-4">
  <div class="row">
    @if(Auth::user()->role == 1)
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Bills</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $bills->where('status', 1)->count() }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $users }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-dark shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @foreach ($bills as $bi)
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header mx-4 p-3 text-center">
              <img src="{{ asset('assets/eco-house.png') }}" alt="" style="width: 50px; height: auto">
          </div>
          <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center mb-0">{{ $bi->User->name }}</h6>
            <span class="text-xs">Acc. No: <span class="fw-bolder">{{ $bi->User->account_number }}</span></span>
            <div class="text-xs">Address: <span class="fw-bolder">{{ $bi->User->location }}</span></div>
            <div class="row mt-2">
              <div class="col-md-6">
                <p class="text-xs mb-0">Rate/KWH: <span class="text-lg fw-bolder">{{ $bi->rate }}</span></p>
              </div>
              <div class="col-md-6">
                <p class="text-xs">KWH Used: <span class="text-lg fw-bolder">{{ $bi->kwh }}</span></p>
              </div>
            </div>
            @if($bi->status == 1)
              <span class="text-danger text-sm fw-light">Pending</span>
            @endif
            @if($bi->status == 2)
              @if(Auth::user()->role == 1)
                <span class="text-info text-sm fw-light">Paid through 
                  @if($bi->payment_method == 1)
                    GCash
                  @endif
                  @if($bi->payment_method == 2)
                    PayMaya
                  @endif
                </span>
                <span><a href="#" data-id="{{ $aes->encrypt($bi->id) }}" id="confirm-bill" class="btn btn-sm bg-gradient-success text-capitalize ms-2 mt-3">Confirm</a></span>
              @endif
              @if(Auth::user()->role == 2)
                <span class="text-info text-sm fw-light">Payment sent through 
                  @if($bi->payment_method == 1)
                    GCash
                  @endif
                  @if($bi->payment_method == 2)
                    PayMaya
                  @endif
                </span>
              @endif
            @endif
            @if($bi->status == 3)
              <span class="text-xs">Status: <span class="text-success text-sm fw-light">Bill Paid! </span></span>
            @endif
            @if($bi->status == 2 || $bi->status == 3)
            <div>
              <a href="{{ route('view-receipt', ['id' => $aes->encrypt($bi->id)]) }}" class="text-xs text-decoration-underline my-0">View Receipt</a>
            </div>
            @endif
            <hr class="">

                <div class="row">
                  <div class="col-md-6">
                    @if($bi->status == 2 || $bi->status == 3)
                      <p class="text-xs my-0 text-start">Paid On: {{ date('M d, Y', strtotime($bi->paid_on)) }}</p>
                    @else
                    <p class="text-xs my-0 text-start text-danger">Not Paid</p>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <h5 class="my-0 text-end">₱ {{ number_format($bi->total_bill, 2) }}</h5>
                  </div>
                </div>

            @if(Auth::user()->role == 1)
              @if($bi->status == 1)
              <div class="row mt-2 pb-4">
                <div class="col-md-6">
                  <a href="{{ route('edit-bill', ['id' => $aes->encrypt($bi->id)]) }}" class="text-xs text-info"><i class="fas fa-pen-nib"></i> Edit</a>
                </div>
                <div class="col-md-6">
                  <a href="#" class="text-xs text-danger" id="delete-bill" data-id="{{ $aes->encrypt($bi->id) }}"><i class="fas fa-trash"></i> Delete</a>
                </div>
              </div>
              @endif
            @endif
            @if(Auth::user()->role == 2)
              @if($bi->status == 1)
              <form action="" id="pay-bill">
                @csrf
                <input type="hidden" name="id" value="{{ $aes->encrypt($bi->id) }}" class="form-control" required>
                <div class="row mt-2">
                  <div class="col-md-6 mb-2">
                    <label for="">Payment Method</label>
                    <select name="payment_method" id="" class="form-select text-sm" required>
                      <option value="">Select...</option>
                      <option value="1">G-Cash</option>
                      <option value="2">PayMaya</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-2">
                    <label for="">Phone Number</label>
                    <input type="number" class="form-control" name="account_number" required>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-sm bg-gradient-success">Pay</button>
                  </div>
                </div>
              </form>
              @endif
            @endif
            
          </div>
        </div>
      </div>
    @endforeach
    
  </div>
  @include('layouts.footers.auth.footer')
  </div>
</main>
@endsection

@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  @include('layouts.navbars.auth.nav', ['title' => 'Edit Bill'])
  <div class="container-fluid py-4">
  <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6>Edit Bill</h6>

                    <hr>
                
                    <form action="" id="update-bill" class="my-0">
                        @csrf
                        <input type="hidden" name="id" value="{{ $aes->encrypt($bills->id) }}" class="form-control" required>
                        
                        <label for="">Select User</label>
                        <select name="name" id="" class="form-select" required>
                            <option value="">Select...</option>
                            @foreach ($user as $us)
                                <option value="{{ $aes->encrypt($us->id) }}" @if($us->id == $bills->userid) selected @endif>{{ $us->name }}</option>
                            @endforeach
                        </select>

                        <label for="">Rate per KWH</label>
                        <input type="number" name="rate" step="any" min="0" id="rate" value="{{ $bills->rate }}" class="form-control" required>

                        <label for="">Total KWH</label>
                        <input type="number" name="kwh" step="any" min="0" id="kwh" value="{{ $bills->kwh }}" class="form-control" required>
                       
                        <label for="">Total Bill Amount</label>
                        <input type="number" name="total_bill" step="any" value="{{ $bills->total_bill }}" id="bill" class="form-control" readonly>

                        <label for="">Due Date</label>
                        <input type="date" name="due" class="form-control" value="{{ $bills->due }}" required min="{{ date('Y-m-d') }}">

                        <div class="d-flex justify-content-center mt-4">
                            <button  class="btn btn-sm bg-dark text-white text-capitalize">Update Bill</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
  </div>
  @include('layouts.footers.auth.footer')
  </div>
</main>
@endsection

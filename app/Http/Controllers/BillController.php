<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bills;
use Illuminate\Support\Carbon;
use App\Http\Controllers\AESCipher;

class BillController extends Controller
{
    public function createBill() {
        $user = User::where('role', 2)->get();
        return view('create-bill', ['user' => $user]);
    }

    public function storeBill(Request $request) {
        $aes = new AESCipher();
        Bills::create([
            'userid' => $aes->decrypt($request->name),
            'rate' => $request->rate,
            'kwh' => $request->kwh,
            'total_bill' => $request->total_bill,
            'due' => $request->due,
            'status' => 1,
        ]);

        return response()->json(['Error' => 0, 'Message' => 'Bill sent successfully!'], 200);
    }

    public function editBill(Request $request) {
        $aes = new AESCipher();
        
        $bills = Bills::where('id', $aes->decrypt($request->id))->first();
        $user = User::where('role', 2)->get();

        return view('edit-bill', ['bills' => $bills, 'user' => $user]);
    }

    public function updateBill(Request $request) {
        $aes = new AESCipher();

        Bills::where('id', $aes->decrypt($request->id))->update([
            'userid' => $aes->decrypt($request->name),
            'rate' => $request->rate,
            'kwh' => $request->kwh,
            'total_bill' => $request->total_bill,
            'due' => $request->due,
        ]);

        return response()->json(['Error' => 0, 'Message' => 'Bill updated successfully!'], 200);
    }

    public function deleteBill(Request $request) {
        $aes = new AESCipher();

        Bills::where('id', $aes->decrypt($request->id))->delete();
        return response()->json(['Error' => 0, 'Message' => 'Bill deleted successfully!'], 200);
    }

    public function payBill(Request $request) {
        $aes = new AESCipher();

        Bills::where('id', $aes->decrypt($request->id))->update([
            'status' => 2,
            'payment_method' => $request->payment_method,
            'paid_on' => Carbon::now()
        ]);

        $bills = Bills::where('id', $aes->decrypt($request->id))->first();

        $request->session()->put('amount', $bills->total_bill);
        $request->session()->put('date', $bills->paid_on);

        if($request->payment_method == 1)
            return response()->json(['Error' => 0, 'Path' => '/gcash'], 200);
        if($request->payment_method == 2)
            return response()->json(['Error' => 0, 'Path' => '/paymaya'], 200);
    }

    public function gcash() {
        return view('gcash');
    }

    public function paymaya() {
        return view('paymaya');
    }

    public function viewReceipt(Request $request) {
        $aes = new AESCipher();

        $bills = Bills::where('id', $aes->decrypt($request->id))->first();

        $request->session()->put('amount', $bills->total_bill);
        $request->session()->put('date', $bills->paid_on);

        if($bills->payment_method == 1)
            return view('gcash');
        if($bills->payment_method == 2)
            return view('paymaya');    
    }

    public function confirmBill(Request $request) {
        $aes = new AESCipher();

        Bills::where('id', $aes->decrypt($request->id))->update(['status' => 3]);
        return response()->json(['Error' => 0, 'Message' => 'Bill payment confirmed successfully!'], 200);
       
    }
}

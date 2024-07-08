<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\order;
use App\Models\payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->route('id');
        $payments = DB::table('payments')->where('order_id',$id)->get();
        return view('pages.menu.payment', compact('payments','id'));
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        DB::table('payments')
                ->where('order_id', $id)
                ->update(['payment_status' => 'completed']);
        return redirect()->route('order');
    }
}

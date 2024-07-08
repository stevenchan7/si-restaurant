<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\tables;
use App\Models\customers;
use App\Models\employees;
use App\Models\order;
class OrderController extends Controller
{
    public function index()
    {
        $tables= DB::table('tables')->where('status','available')->get();
        $customers = DB::table('customers')->get();
        $employees = DB::table('employees')->get();
        return view('pages.menu.order', compact('employees','customers','tables'));
    }
    public function store(Request $request)
    {
        $order= DB::table('orders')->get();
        $order = new order();
        $order->employee_id = $request->get('employee');
        $order->customer_id = $request->get('customer');
        $order->table_id = $request->get('table');
        $order->order_time = now();
        $order->status = 'diproses';
        $order->dine_in = true;
        $order->notes = $request->get('notes');
        $order->save();
        DB::table('tables')
                ->where('id', $request->get('table'))
                ->update(['status' => 'busy']);
        return redirect()->route('menu_selection',['id' => $order->id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\orderDetails;
use App\Models\order;
use App\Models\payment;
class MenuController extends Controller
{
    public function create()
    {
        // tampilkan form untuk membuat pesanan
        return view('pages.orders.create');
    }
    public function store(Request $request)
    {
        $menus = json_decode($request->input('selected_menus'), true);
        $subtotal = 0;
        $id = $request->route('id');
        foreach ($menus as $menu) {
            orderDetails::create([
                'order_id'=> $id,
                'menu' => $menu['name'],
                'amount' => $menu['quantity'],
                $subtotal += $menu['price'] * $menu['quantity'],
            ]);
        }
        payment::create([
            'order_id'=>$id,
            'payment_method'=> 'cash',
            'total'=>$subtotal,
            'payment_status'=> 'pending',
            'payment_date'=> now(),
        ]);
        $id = $request->route('id');
        return redirect()->route('payment',['id' => $id]);
    }

    public function confirm($id)
    {
        $order = Order::with('orderDetails.menu')->find($id);
        return view('pages.orders.confirm', compact('order'));
    }

    public function index(Request $request)
    {
        $menus = Menu::all();
        $id = $request->route('id');
        return view('pages.menu.menus_selection', compact('menus','id'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $menus = Menu::query();

        if ($query) {
            $searchedMenus = $menus->where('name', 'like', '%' . $query . '%')->get();
            $otherMenus = $menus->where('name', 'not like', '%' . $query . '%')->get();
        } else {
            $searchedMenus = collect();
            $otherMenus = $menus->get();
        }

        $menus = $searchedMenus->merge($otherMenus);

        return view('pages.menu.menus_selection', compact('menus', 'query'));
    }

}

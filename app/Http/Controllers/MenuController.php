<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\orderDetails;
use App\Models\order;
class MenuController extends Controller
{
    public function index()
    {
        $Menu= DB::table('menus')
                    ->orderBy('id','ASC')
                    ->get();
        return view('pages.menu.index');
    }
}

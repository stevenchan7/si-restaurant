<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GenerateReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ]);

        $from = $validated['from'];
        $to = $validated['to'];

        $orderDetails = OrderDetail::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->get();

        $res = OrderDetail::join('menus', 'order_details.menu_id', '=', 'menus.id')
            ->selectRaw('SUM(total) as sum_total, SUM(order_details.qty * menus.base_price) as sum_modal')
            ->where('order_details.created_at', '>=', $from)
            ->where('order_details.created_at', '<=', $to)
            ->first();

        $revenue = $res->sum_total - $res->sum_modal;

        $data = array(
            'orderDetails' => $orderDetails,
            'revenue' => $revenue,
            'from' => $from,
            'to' => $to
        );

        $pdf = Pdf::loadView('admin.report', $data);

        return $pdf->stream();
    }
}

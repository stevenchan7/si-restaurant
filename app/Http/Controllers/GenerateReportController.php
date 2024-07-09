<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function generateReport(Request $request)
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
    public function generateSalaryReport(Request $request)
    {
        $today = date("Y-m-d H:i:s");
        $salaries = Salary::all();

        $data = array(
            'date' => $today,
            'salaries' => $salaries
        );

        $pdf = Pdf::loadView('admin.salaryReport', $data);
        return $pdf->stream();
    }

    public function generatePayrollReport(Request $request)
    {
        $today = date("Y-m-d H:i:s");
        $payrolls = Payroll::all();

        $data = array(
            'date' => $today,
            'payrolls' => $payrolls
        );

        $pdf = Pdf::loadView('admin.payrollReport', $data);
        return $pdf->stream();
    }

    public function generatePayrollDetailsReport(Employee $employee)
    {
        $today = date("Y-m-d H:i:s");
        $payrolls = Payroll::where('employee_id', $employee->id)->get();

        $data = array(
            'date' => $today,
            'employee' => $employee,
            'payrolls' => $payrolls
        );

        $pdf = Pdf::loadView('admin.payrollDetailsReport', $data);
        return $pdf->stream();
    }
}

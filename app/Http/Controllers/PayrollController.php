<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $payrolls = Payroll::all();
        return view('pages.payroll.index')
            ->with('employees', $employees)
            ->with('payrolls', $payrolls);
    }

    public function getPayrollData(Request $request)
    {
        $empId = $request->query('employee');
        $month = $request->query('month');

        $emp = Employee::findOrFail($empId);

        $salary = $emp->salary->salary;

        $overtimes = $emp->overtimes()->whereMonth('date', $month)->get();
        $overtimeTotal = 0;

        foreach ($overtimes as $overtime) {
            $overtimeTotal += $overtime->total_pay;
        }

        $dayoffs = $emp->dayoffs()->whereMonth('date', $month)->get();
        $dayoffTotal = (ceil($salary / 30)) * $dayoffs->count();

        return response()->json([
            'success' => true,
            'salary' => $salary,
            'overtimes' => $overtimes,
            'dayoffs' => $dayoffs,
            'overtimeTotal' => $overtimeTotal,
            'dayoffTotal' => $dayoffTotal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employeeId' => ['required', 'numeric', 'exists:employees,id'],
            'month' => ['required', 'numeric', 'min:1', 'max:12']
        ]);

        $emp = Employee::findOrFail($validated['employeeId']);

        // Check if payroll for this month exist
        $existingPayroll = $emp->payrolls()->whereMonth('created_at', $validated['month'])->first();
        if ($existingPayroll) {
            return response()->json([
                'success' => false,
                'errors' => array(
                    'Payroll for this month paid'
                )
            ], 400);
        }

        $salary = $emp->salary->salary;

        $overtimes = $emp->overtimes()->where('paid', 0)->whereMonth('date', $validated['month'])->get();
        $overtimeTotal = 0;

        foreach ($overtimes as $overtime) {
            $overtimeTotal += $overtime->total_pay;
        }

        $dayoffs = $emp->dayoffs()->where('paid', 0)->whereMonth('date', $validated['month'])->get();
        $dayoffTotal = (ceil($salary / 30)) * $dayoffs->count();

        $payTotal = $salary + $overtimeTotal - $dayoffTotal;

        Payroll::create([
            'salary' => $salary,
            'overtime' => $overtimeTotal,
            'cut' => $dayoffTotal,
            'total' => $payTotal,
            'month' => $validated['month'],
            'employee_id' => $validated['employeeId']
        ]);

        // Mark as paid
        $emp->dayoffs()
            ->where('paid', 0)
            ->whereMonth('date', $validated['month'])
            ->update(['paid' => 1]);
        $emp->overtimes()
            ->where('paid', 0)
            ->whereMonth('date', $validated['month'])
            ->update(['paid' => 1]);

        return response()->json([
            'success' => true,
            'msg' => 'Add payroll success'
        ]);
    }

    public function dashboard(Request $request)
    {
        $from = Carbon::now()->subMonths(6);

        $orderTotalPerMonth = OrderDetail::where('created_at', '>=', $from)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.index')
            ->with('orderTotalPerMonth', $orderTotalPerMonth);
    }

    public function dashboardDataByDate(Request $request)
    {
        $validated = $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ]);

        $from = $validated['from'];
        $to = $validated['to'];

        $count = OrderDetail::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->count();

        $topMenuIds = OrderDetail::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->selectRaw('menu_id, SUM(qty) as total_qty')
            ->groupBy('menu_id')
            ->orderBy('total_qty', 'desc')
            ->limit(3)
            ->pluck('menu_id');

        $topMenus = array();

        foreach ($topMenuIds as $id) {
            $menu = Menu::findOrFail($id);
            array_push($topMenus, $menu);
        }

        $res = OrderDetail::join('menus', 'order_details.menu_id', '=', 'menus.id')
            ->selectRaw('SUM(total) as sum_total, SUM(order_details.qty * menus.base_price) as sum_modal')
            ->where('order_details.created_at', '>=', $from)
            ->where('order_details.created_at', '<=', $to)
            ->first();

        $revenue = $res->sum_total - $res->sum_modal;

        return response()->json([
            'count' => $count,
            'topMenus' => $topMenus,
            'revenue' => $revenue
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

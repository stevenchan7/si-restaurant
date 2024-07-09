<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
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

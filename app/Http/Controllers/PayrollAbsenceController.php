<?php

namespace App\Http\Controllers;

use App\Models\Dayoff;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Salary;
use Illuminate\Http\Request;

class PayrollAbsenceController extends Controller
{
    public function index()
    {
        $salaries = Salary::all();
        $employees = Employee::all();
        $overtimes = Overtime::all();
        $dayoffs = Dayoff::all();
        return view('pages.payroll.absence.index')
            ->with('salaries', $salaries)
            ->with('employees', $employees)
            ->with('overtimes', $overtimes)
            ->with('dayoffs', $dayoffs);
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
    public function storeOvertime(Request $request)
    {
        $validated = $request->validate([
            'employeeId' => ['required', 'numeric', 'exists:employees,id'],
            'date' => ['required'],
            'overtimeHour' => ['required', 'numeric', 'min:1', 'max:24']
        ]);

        $emp = Employee::findOrFail($validated['employeeId']);

        $payPerHour = $emp->salary->overtime;
        $totalPay = $payPerHour * $validated['overtimeHour'];

        Overtime::create([
            'date' => $validated['date'],
            'pay_per_hour' => $payPerHour,
            'total_hour' => $validated['overtimeHour'],
            'total_pay' => $totalPay,
            'employee_id' => $validated['employeeId']
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Add data success'
        ], 201);
    }

    public function storeDayoff(Request $request)
    {
        $validated = $request->validate([
            'employeeId' => ['required', 'numeric', 'exists:employees,id'],
            'date' => ['required'],
        ]);

        Dayoff::create([
            'date' => $validated['date'],
            'employee_id' => $validated['employeeId']
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Add data success'
        ], 201);
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
    public function destroyOvertime(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'numeric', 'exists:overtimes,id']
        ]);

        Overtime::destroy($validated['id']);

        return response()->json([
            'success' => true,
            'msg' => 'Delete data success'
        ], 201);
    }

    public function destroyDayoff(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'numeric', 'exists:overtimes,id']
        ]);

        Dayoff::destroy($validated['id']);

        return response()->json([
            'success' => true,
            'msg' => 'Delete data success'
        ], 201);
    }
}

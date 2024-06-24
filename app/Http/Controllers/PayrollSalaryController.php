<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class PayrollSalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::all();
        $employees = Employee::all();
        return view('pages.payroll.salary.index')
            ->with('salaries', $salaries)
            ->with('employees', $employees);
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
            'salary' => ['required', 'numeric', 'max:1000000000'],
            'overtime' => ['required', 'numeric', 'max:1000000000']
        ]);

        $salary = Salary::create([
            'employee_id' => $validated['employeeId'],
            'salary' => $validated['salary'],
            'overtime' => $validated['overtime']
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Add data success',
            'data' => $salary
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
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'numeric', 'exists:salaries,id'],
            'salary' => ['required', 'numeric', 'max:1000000000'],
            'overtime' => ['required', 'numeric', 'max:1000000000']
        ]);

        $salary = Salary::findOrFail($validated['id']);

        $salary->salary = $validated['salary'];
        $salary->overtime = $validated['overtime'];
        $salary->save();

        return response()->json([
            'success' => true,
            'msg' => 'Update data success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'numeric', 'exists:salaries,id']
        ]);

        Salary::destroy($validated['id']);

        return response()->json([
            'success' => true,
            'msg' => 'Delete data success'
        ]);
    }
}

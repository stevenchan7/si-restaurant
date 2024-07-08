<?php

namespace App\Http\Controllers;
use App\Models\OrderLog;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inventories = Inventory::all();
        $employees = Employee::all();
        return view('pages.inventory.index', compact('inventories', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventory.create', [
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'unit' => 'required|max:255',
            'price' => 'required|integer',
            'minimum_stock' => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        $validatedData['stock'] = 0;

        Inventory::create($validatedData);

        return redirect('/inventory')->with('success', 'Ingredients created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        $inventory->load('supplier');
        return view('pages.inventory.show', [
            'ingredient' => $inventory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventory = Inventory::find($id);
        return view('pages.inventory.edit', [
            'inventory' => $inventory,
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'unit' => 'required|max:255',
            'price' => 'required|integer',
            'minimum_stock' => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->update($validatedData);

        return redirect('/inventory')->with('success', 'Ingredients updated successfully');
    }

    public function order(Request $request, $id)
    {
        Log::info('Order request received:', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
            'employee' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the inventory item
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->back()->with('error', 'Inventory item not found');
        }

        // Create the order log
        $orderLog = new OrderLog();
        $orderLog->quantity = $request->input('quantity');
        $orderLog->price = $inventory->price;
        $orderLog->total_price = $inventory->price * $request->input('quantity');
        $orderLog->employee_id = $request->input('employee');
        $orderLog->ingredient_id = $id;
        $orderLog->save();

        // Update the inventory stock
        $inventory->stock += $request->input('quantity');
        $inventory->save();

        return redirect()->back()->with('success', 'Order placed successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect('/inventory')->with('success', 'Ingredients deleted successfully');
    }

    public function updateStock(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'stock' => 'required|numeric',
        ]);

        $inventory = Inventory::find($id);
        $inventory->stock += $validatedData['stock'];
        $inventory->save();

        return redirect('/inventory')->with('success', 'Stock updated successfully');
    }

    public function showLogs()
    {
        $logs = OrderLog::all();
        return view('pages.inventory.log', compact('logs'));
    }

    // public function subtractStock(Request $request, string $id)
    // {
    //     $validatedData = $request->validate([
    //         'stock' => 'required|numeric',
    //     ]);

    //     $inventory = Inventory::find($id);
    //     $inventory->stock -= $validatedData['stock'];
    //     $inventory->save();

    //     return redirect('/inventory')->with('success', 'Stock updated successfully');
    // }
}

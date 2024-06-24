<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Inventory;
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
        $search = $request->input('search');

        // If there's a search query, filter the inventories based on the name
        if ($search) {
            $inventories = Inventory::where('name', 'like', '%' . $search . '%')->get();
        } else {
            // If there's no search query, retrieve all inventories
            $inventories = Inventory::all();
        }
        
        return view('pages.inventory.index', compact('inventories'));
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
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the inventory item
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->back()->with('error', 'Inventory item not found');
        }

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
}

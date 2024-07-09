<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // If there's a search query, filter the suppliers based on the name
        if ($search) {
            $suppliers = Supplier::where('name', 'like', '%' . $search . '%')->get();
        } else {
            // If there's no search query, retrieve all suppliers
            $suppliers = Supplier::all();
        }
        
        return view('pages.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
        ]);

        Supplier::create($validatedData);

        return redirect('/suppliers')->with('success', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id); // Fetch the supplier by ID
        
        return view('pages.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'address' => 'required|max:255',
        ]);

        // Find the supplier by ID
        $supplier = Supplier::findOrFail($id);

        // Update the supplier's attributes
        $supplier->name = $validatedData['name'];
        $supplier->email = $validatedData['email'];
        $supplier->phone = $validatedData['phone'];
        $supplier->address = $validatedData['address'];
        $supplier->save();

        // Redirect back to supplier list with success message
        return redirect('/suppliers')->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'Supplier deleted successfully');
    }
}

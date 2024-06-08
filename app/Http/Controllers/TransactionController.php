<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('Product', 'ProductType')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', fn ($row) => view('components.table-action',
                        [
                            'routeView' => route('transactions.show', $row->id),
                            'routeEdit' => route('transactions.edit', $row->id),
                            'routeDelete' => route('transactions.destroy', $row->id)
                        ]))
                    ->rawColumns(['action'])
                    ->make();
        }

        return view('pages.transactions-index');
    }

    public function typeComparison(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->has('startDate') ? date($request->input('startDate')) : date('Y-m-d');
            $endDate = $request->has('endDate') ? date($request->input('endDate')) : date('Y-m-d');

            $data = DB::table('transactions')
            ->join('product_types', 'transactions.product_type_id', '=', 'product_types.id')
            ->select(DB::raw('product_types.name AS PTName, MIN(sold) AS _min, MAX(sold) AS _max'))
            ->whereBetween('transactions.updated_at', [$startDate, $endDate], 'AND')
            ->orWhereBetween('transactions.created_at', [$startDate, $endDate], 'AND')
            ->groupBy('PTName')
            ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->make();
        }

        return view('pages.transactions-typecomparison');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $productsTypes = ProductType::all();

        return view('pages.transactions-create', compact('products', 'productsTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => ['required', 'integer'],
                'sold' => ['required', 'integer', 'min:0']
            ]);

            $product = Product::with('ProductType')->findOrFail($validated['product_id']);

            $validated['product_type_id'] = $product->product_type_id;
            $validated['stock'] = $product->stock;

            $tmpStock = $validated['stock'] - $validated['sold'];

            $product->update(['stock' => $tmpStock]);

            Transaction::create($validated);

            return redirect()->route('transactions.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('transactions.index')->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $transactions = Transaction::with('Product', 'ProductType')->findOrFail($id);

            return view('pages.transactions-show', compact('transactions'));
        } catch (\Throwable $th) {
            return redirect()->route('transactions.index')->with('success', false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $transactions = Transaction::with('Product', 'ProductType')->findOrFail($id);
            $products = Product::all();

            return view('pages.transactions-edit', compact('transactions', 'products'));
        } catch (\Throwable $th) {
            return redirect()->route('transactions.index')->with('success', false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $transactions = Transaction::with('Product', 'ProductType')->findOrFail($id);

            $validated = $request->validate([
                'product_id' => ['required', 'integer'],
                'sold' => ['required', 'integer', 'min:0']
            ]);

            $product = Product::with('ProductType')->findOrFail($validated['product_id']);

            $validated['product_type_id'] = $product->product_type_id;
            $validated['stock'] = $product->stock;

            $tmpStock = $validated['stock'] - $validated['sold'];

            $product->update(['stock' => $tmpStock]);

            $transactions->update($validated);

            return redirect()->route('transactions.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('transactions.index')->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $transactions = Transaction::findOrFail($id);

            $transactions->delete();

            return redirect()->route('transactions.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('transactions.index')->with('success', false);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Ingredient;
use App\Models\Principle;
use App\Models\Product;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * get data with datatable
     */
    public function dataTable()
    {
        $data = Product::with('ingredients', 'principle');

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->filterColumn('principle_id', function ($query, $keyword) {
                $query->whereHas('principle', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->editColumn('photo', function ($each) {
                return '<img src="' . $each->imgUrl() . '" width="100" />';
            })
            ->editColumn('price', function ($each) {
                return number_format($each->price ?? '00000') . ' MMK';
            })
            ->editColumn('principle_id', function ($each) {
                return $each->principle->name;
            })
            ->editColumn('ingredients', function ($each) {
                $output = '';
                foreach ($each->ingredients as $ingredient) {
                    $output .= "<span class='badge bg-warning rounded-pill mb-1 me-1'>$ingredient->name</span>";
                }

                return $output;
            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('product_show')) {
                    $show_icon = '<a href="' . route('admin.products.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('product_edit')) {
                    $edit_icon = '<a href="' . route('admin.products.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('product_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                }

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['photo', 'ingredients', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::pluck('name', 'id');
        $principles = Principle::pluck('name', 'id');

        return view('admin.products.create', compact('ingredients', 'principles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->all());

            if ($request->file('photo')) {
                $fileName = uniqid() . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->storeAs('public/images', $fileName);

                $product->update(['photo' => $fileName]);
            }

            $product->ingredients()->sync($request->input('ingredients', []));

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Successfully Created !');
        } catch (\Exception $error) {
            DB::rollback();
            return back()->withErrors(['fail', 'Something wrong. ' . $error->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->load('ingredients', 'principle');

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = $product->load('ingredients', 'principle');
        $principles = Principle::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'principles', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $oldPhotoName = $product->photo;
        $product->update($request->all());
        if ($request->file('photo')) {
            if ($oldPhotoName) {
                Storage::disk('public')->delete("images/" . $oldPhotoName);
            }

            $newPhotoName = uniqid() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/images', $newPhotoName);
            $product->update(['photo' => $newPhotoName]);
        }

        $product->ingredients()->sync($request->input('ingredients', []));

        return redirect()->route('admin.products.index')->with('success', 'Successfully Edited !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete('images/' . $product->photo);
        $product->delete();

        return 'success';
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePrincipleRequest;
use App\Http\Requests\Admin\UpdatePrincipleRequest;
use App\Models\Principle;
use DataTables;

class PrincipleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.principles.index');
    }

    /**
     * get data with dataTable
     */
    public function dataTable()
    {
        $data = Principle::query();

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('principle_show')) {
                    $show_icon = '<a href="' . route('admin.principles.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('principle_edit')) {
                    $edit_icon = '<a href="' . route('admin.principles.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('principle_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';
                }

                return '<div class="action-icon">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['role', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.principles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrincipleRequest $request)
    {
        Principle::create($request->all());

        return redirect()->route('admin.principles.index')->with('success', 'Successfully Created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Principle $principle)
    {
        return view('admin.principles.show', compact('principle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Principle $principle)
    {
        return view('admin.principles.edit', compact('principle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrincipleRequest $request, Principle $principle)
    {
        $principle->update($request->all());

        return redirect()->route('admin.principles.index')->with('success', 'Successfully Edited !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Principle $principle)
    {
        $principle->delete();

        return 'success';
    }
}

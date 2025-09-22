<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(15);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        DB::beginTransaction();
        try {
            Brand::create($request->all());
            DB::commit();
            return redirect()->route('brand.index')->with('success', 'Marca creada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('brand.index')->with('error', 'Error al crear la marca');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        DB::beginTransaction();
        try {
            $brand->update($request->all());
            DB::commit();
            return redirect()->route('brand.index')->with('success', 'Marca actualizada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('brand.index')->with('error', 'Error al actualizar la marca');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        DB::beginTransaction();
        try {
            $brand->delete();
            DB::commit();
            return redirect()->route('brand.index')->with('success', 'Marca eliminada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('brand.index')->with('error', 'Error al eliminar la marca');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = section::all();
        $products = products::all();
        return view('products.products', compact('sections','products'));
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
        $request->validate([
            'products_name' => 'required|unique:products,products_name|max:255',
             'description' => 'required',
    ],
      [
        'products_name.required' =>'يرجي ادخال اسم القسم',
        'products_name.unique' =>'اسم القسم مسجل مسبقا',
         'description' => 'يرجي ادخال الوصف', 
      ]);
 

        //  return $request ;
            products::create([
             'products_name' => $request->products_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
         session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    
        {
            $id = $request->id;
            $this->validate($request, [
    
                'products_name' => 'required|max:255|unique:products,products_name,'.$id,
                'description' => 'required',
            ],[
    
                'products_name.required' =>'يرجي ادخال اسم القسم',
                'products_name.unique' =>'اسم القسم مسجل مسبقا',
                'description.required' =>'يرجي ادخال البيان',
    
            ]);

            $id = section::where('section_name', $request->section_name)->first()->id;

       $Products = Products::findOrFail($request->pro_id);

       $Products->update([
       'products_name' => $request->products_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back();
             
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Products = Products::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
   }
    }


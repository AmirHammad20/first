<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = section::all();
        return view('section.index',compact('section'));
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
            'section_name' => 'required|unique:sections|max:255',
             'description' => 'required',
    ],
      [
        'section_name.required' =>'يرجي ادخال اسم القسم',
        'section_name.unique' =>'اسم القسم مسجل مسبقا',
         'description' => 'يرجي ادخال الوصف', 
      ]);
 

    // dd($request->all());
    // التاكدمن التسجيل مسبقا 
    // $b_exists= section::where('section_name','=',$request['section_name'])->exists();
    // if($b_exists){
    //     session()->flash('Error','خطا القسم مسجل مسبقا');
    //     return redirect('sections');
    // }
    // else{
        // dd('c');
        section::create([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
            'created_by'=>(Auth()->user()->id),
    ]);
        session()->flash('Add','تم التسجيل بنجاح ');
        return redirect('sections');
    }
    // }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
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

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);


        $sections = section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);
        session()->flash('edit','تم التعديل بنجاح ');
        return redirect('sections');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
     $id = $request->id;
     section::find($id)->delete();  
     session()->flash('delete','تم مسح القسم بنجاح ');
     return redirect('sections');
        

    }
}

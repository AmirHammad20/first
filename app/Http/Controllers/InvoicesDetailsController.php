<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use League\Flysystem\Filesystem;
 use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
// use File;
class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details  = invoices_Details::where('id_Invoice',$id)->get();
        $attachments  = invoices_attachments::where('invoice_id',$id)->get();

        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
     }
     public function get_file($invoice_number,$id,$file_name)

     {
         $contents= Storage::disk('public_upload')->path( $id .'/'.$file_name);
         return response()->download( $contents);
     }
    public function open_file($invoice_number,$id,$file_name)

    {
        $files =Storage::disk('public_upload')->path( $id .'/'.$file_name);
        return response()->file($files);

    }


}
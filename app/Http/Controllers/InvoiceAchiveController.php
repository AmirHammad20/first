<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\invoices;
class InvoiceAchiveController extends Controller
{

    public function index()
    {
      
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.Archive_Invoices',compact('invoices'));
    }



  
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     
     */
    public function store(Request $request)
    {
        //
    }



    public function show($id)
    {
        //
    }

   


    public function edit($id)
    {
        //
    }

  public function update(Request $request)
    {
         $id = $request->invoice_id;
         $flight = Invoices::withTrashed()->where('id', $id)->restore();
         session()->flash('restore_invoice');
         return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
         $invoices = invoices::withTrashed()->where('id',$request->invoice_id)->first();
         $invoices->forceDelete();
         session()->flash('delete_invoice');
         return redirect('/Archive');
    
    }
}
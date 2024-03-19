<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use SoftDeletes ;
    use HasFactory;
     protected $guarded = [];
     public function section()
     {
         return $this->belongsTo(section::class);
      
      }

      public function invoices_details()
      {
          return $this->belongsTo(invoices_details::class);
       
       }

}

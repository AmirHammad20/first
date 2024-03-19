<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function section()
{
    return $this->belongsTo(section::class);

 
 }
}

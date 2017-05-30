<?php

namespace App;
use App\Invoice;

use Illuminate\Database\Eloquent\Model;

class itemlst extends Model
{
    protected $fillable = ['invoice_id','iname','itname','qty','price','total'];
     public static function scopeIncomplete($query)
   {
   		return $query->where('completed',1)->get();

   }
   public function isComplete()
   {
   		return false;
   }
   public function invoice()
    {
    	return $this->belongsTo('Invoice::class');
    }
}

<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = ['invoice','items','subtotal','tax','alltotal'];
     public static function scopeIncomplete($query)
   {
   		return $query->where('completed',1)->get();

   }
   public function isComplete()
   {
   		return false;
   }
      public function itemlsts()
    {
        return $this->hasMany('App\itemlst');
    }

}

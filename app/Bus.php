<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    

    public function operator()
     {
          return $this->belongsTo(Operator::class);
     }
}

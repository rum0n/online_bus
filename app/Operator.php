<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    public function AllBus()
     {
          return $this->hasMany(Bus::class);
     }
}

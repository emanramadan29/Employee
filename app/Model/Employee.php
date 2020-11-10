<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable =['name','salary','bonus_percentage'];

    public function sal(){
        return $this->hasOne(Salary::class);
    }
}

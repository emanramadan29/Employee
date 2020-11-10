<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable=[
        'employee_id',
        'Salaries_payment_day',
        'Bonus_payment_day',
        'Month',
        'Bonus_total',
        'Payments_total',
        'Salaries_total'
        ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}

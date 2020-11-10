<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'Month' => $this->Month,
            'Salaries_payment_day' => $this->Salaries_payment_day,
             'Bonus_payment_day'=>$this->Bonus_payment_day,
             'Salaries_total'=>$this->Salaries_total ,
              'Bonus_total'=>$this->Bonus_total,
              'Payments_total'=>$this->Payments_total
        ];
    }
}

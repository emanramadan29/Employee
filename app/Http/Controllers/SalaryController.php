<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalaryResource;
use App\Model\Employee;
use App\Model\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class SalaryController extends Controller
{
    public function getMonthlySalary(Carbon $date)
    {

        $currentdate=$date->now()->isoFormat('D');
        $lastDayofMonthName =    $date->endOfMonth()->isoFormat('dddd');
        $lastDayofMonthNum =    $date->endOfMonth()->isoFormat('D');
        $midMounthDay=(Carbon::parse('15th ' . date('M')))->format('D');
        $emps=Employee::with('sal')->get();


        while ($currentdate == $lastDayofMonthNum  && $lastDayofMonthName !=="Friday"
            && $lastDayofMonthName !=="Saturday" ){

            foreach ($emps as $emp){
                $sal=Salary::create([
                    'Month'=>now()->format('F'),
                    'employee_id'=>$emp->id,
                    'Salaries_payment_day'=>$lastDayofMonthNum,
                    'Salaries_total'=>$emp->salary,
                    'Bonus_total'=>(($emp->salary * $emp->bonus_percentage)/100),
                    'Payments_total'=>($emp->salary) + (($emp->salary * $emp->bonus_percentage)/100),
                ]);
            }

        }

        if ($lastDayofMonthName =="Friday"){
            foreach ($emps as $emp){
                $sal=Salary::create([
                    'Month'=>now()->format('F'),
                    'employee_id'=>$emp->id,
                    'Salaries_payment_day'=>(int)$lastDayofMonthNum -1 ,
                    'Salaries_total'=>$emp->salary,
                    'Bonus_total'=>(($emp->salary * $emp->bonus_percentage)/100),
                    'Payments_total'=>($emp->salary) + (($emp->salary * $emp->bonus_percentage)/100),
                ]);
            }
        }

        if ($lastDayofMonthName =="Saturday"){
            foreach ($emps as $emp){
                $sal=Salary::create([
                    'Month'=>now()->format('F'),
                    'employee_id'=>$emp->id,
                    'Salaries_payment_day'=>(int)$lastDayofMonthNum -2 ,
                    'Salaries_total'=>$emp->salary,
                    'Bonus_total'=>(($emp->salary * $emp->bonus_percentage)/100),
                    'Payments_total'=>($emp->salary) + (($emp->salary * $emp->bonus_percentage)/100),
                ]);
            }
        }

        if ($midMounthDay == "Sat" | $midMounthDay=="Fri"){
            foreach ($emps as $emp){
                $sal->update([
                    'Bonus_payment_day'=>date("j", strtotime("next thursday")),
                ]);
            }

        }

        $empsal=SalaryResource::collection(Salary::where('Month',now()->format('F'))->get());

        return response()->json(['message'=>'Success','data'=>$empsal],200);

    }
}

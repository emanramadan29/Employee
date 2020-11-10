<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:view_employees', ['only' => ['index']]);
        $this->middleware('permission:add_employees', ['only' => ['create','store']]);
        $this->middleware('permission:edit_employees', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_employees', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp=EmployeeResource::collection(Employee::all());
        if (empty($emp)){
            return response()->json(['message'=>'There is no data' ,'data'=>$emp],200);
        }else{
            return response()->json(['message'=>'Data retrive success','data'=>$emp],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'salary'=>'required|',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>'Error','data'=>$validator->errors()->first()],422);
        }

        $emp=Employee::create([
            'name'=>$request->name,
            'salary'=>$request->salary,
        ]);
        $em=new EmployeeResource($emp);
        return response()->json(['message'=>'Added Successfuly','data'=>$em],200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp=new EmployeeResource(Employee::find($id));
        if (is_null($emp)){
            return response()->json(['message'=>'Record not found' ,'data'=>[]], 404);
        }else{
            return response()->json(['message'=>'Success','data'=>$emp], 200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'salary'=>'required|',
            'bonus_percentage'=>'min:1|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>'Error','data'=>$validator->errors()->first()],422);
        }

        $emp=Employee::find($id);

        $emp->update([
            'name'=>$request->name,
            'salary'=>$request->salary,
            'bonus_percentage'=>$request->bonus_percentage

        ]);
        $em=new EmployeeResource($emp);
        return response()->json(['message'=>'Updated Successfuly','data'=>$em],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp=Employee::find($id);
        $em=new EmployeeResource($emp);
        if (is_null($emp)){
            return response()->json(['message'=>'Record not found' ,'data'=>[]], 404);

        }else{
            $emp->delete();
            $em=new EmployeeResource($emp);
            return response()->json(['message'=>'Deleted Successfuly','data'=>$em],200);
        }


    }
}

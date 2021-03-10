<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\web_lara1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
                                                                          
        $validator =Validator::make($request->all(),['user_id'=>['required'],'task'=>['required']]);
        

        if($validator->fails()){
            $v=$validator->messages()->toArray();
            $m=array();
            foreach($v as $ke=>$val){
                array_push($m,$val[0]);
            }
            return response()->json(['status'=>0,'message'=>$m,400]); 
        }

        $user=web_lara1::where('name',"=",$request->user_id)->first();
        $u1=web_lara1::where('email','=',$request->user_id)->first();
        if($user!=null || $u1!=null){
            $entity=new Task;
            $v=Str::uuid();
            $entity->id=$v;
            $entity->user_id=$request->user_id;
            $entity->task=$request->task;
            $entity->status="pending";
            $entity->save();
            return response()->json(['task'=>$entity,'status'=>1,'message'=>'successfully created a task']);
        }else{
            error_log("lkoi");
            return response()->json(['status'=>0,'message'=>['entered1 user is invalid']]);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $post=Task::where('id',$request->task_id)->first();
        if($post!=null){
            if($request->status=="pending"|| $request->status=="done"){
                $post->status=$request->status;
                $post->save();
                return response()->json(['task'=>$post,'status'=>1,'message'=>'successfully updated a task']);

            }else{
                return response()->json(['status'=>0,'message'=>'entered status is invalid']);
            }
        }else{
            return response()->json(['status'=>0,'message'=>'entered user is invalid']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}

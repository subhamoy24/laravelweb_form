<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\web_lara1;
use App\Models\Task;
use Session;
class LoginController extends Controller
{
    public function store(Request $request)
    {
        $user=web_lara1::where('name',"=",$request->name)->first();
        $u1=web_lara1::where('email','=',$request->name)->first();
        if($user!=null){
            $arr=[$user->name,$user->email,$user->pincode];
            $request->session()->put('LoggedUser',$arr);
            return redirect('dash');
        }elseif($u1!=null){
            $arr=[$u1->name,$u1->email,$u1->pincode];
            $request->session()->put('LoggedUser',$arr);
            return redirect('dash');
        }else{
            return back()->session()-flash('error','entered user id is invalid');

        }
    }
    public function show(Request $request)
    {
        $p=Task::where('user_id',"=",$request->user_id)->get();
        if($p!=null){
            $p=$p->toArray();
            return response()->json(['status'=>1,'data'=>$p]);
        }else{
            return response()->json(['status'=>0,'data'=>'error']);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $todays_task = Task::where('created_by',Auth::user()->id)
                        ->where('date',date('Y-m-d'))
                        ->get();

        $todays_task_count = $todays_task->count();

        $todays_progress = Task::where('created_by',Auth::user()->id)
                        ->where('date',date('Y-m-d'))
                        ->where('status','=',1)
                        ->get();
        $todays_progress_count = $todays_progress->count();

        $pending_task = Task::where('created_by',Auth::user()->id)
                        ->where('status','=',0)
                        ->get();
        $completed_task = Task::where('created_by',Auth::user()->id)
                        ->where('status','=',1)
                        ->get();

        $pending_count = $pending_task->count();
        $completed_count = $completed_task->count();



        return view('dashboard',compact('todays_task','todays_task_count','pending_task','completed_task','pending_count','completed_count','todays_progress','todays_progress_count'));
    }

    public function setting()
    {
        $user = Auth::user();
        return view('setting.index',compact('user'));
    }

    public function settingsave(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!(is_null($request->password)))
        {
            if($request->password == $request->c_password)
            {
                $user->password = $request->password;
            }
        }
        $user->save();
        return redirect()->route('setting')->with('message','Data updated Successfully');
    }
}

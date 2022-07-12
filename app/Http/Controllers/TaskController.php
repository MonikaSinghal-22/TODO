<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = DB::table('tasks')
                    ->select('*')
                    ->where('created_by',Auth::user()->id)
                    ->where('date',date('Y-m-d'))
                    ->orderBy('order')
                    ->get();

        return view('task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
          ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        if(is_null($request->date))
        {
            $date = date('Y-m-d');
        }
        else
        {
            $date = $request->date;
        }
        $task->date = $date;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        if(is_null($request->order))
        {
            $data = DB::table('tasks')
                    ->select('order')
                    ->where('created_by','=',Auth::user()->id)
                    ->where('date','=',$date)
                    ->orderBy('order','desc')
                    ->first();
            if(is_null($data))
            {
                $order = 0;
            }
            else
            {
                $order = $data->order;
            }
            $task->order = ($order + 1);
        }
        else
        {
            $task->order = $request->order;
        }
        $task->status = 0;
        $task->created_by = Auth::user()->id;
        $task->save();
        return redirect()->route('task.index')->with('message','Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit',compact('task'));
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
        $request->validate([
            'title' => ['required', 'string'],
          ]);

        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        if(is_null($request->date))
        {
            $date = date('Y-m-d');
        }
        else
        {
            $date = $request->date;
        }
        $task->date = $date;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        if(is_null($request->order))
        {
            $data = DB::table('tasks')
                    ->select('order')
                    ->where('created_by','=',Auth::user()->id)
                    ->where('date','=',$date)
                    ->orderBy('order','desc')
                    ->first();
            if(is_null($data))
            {
                $order = 0;
            }
            else
            {
                $order = $data->order;
            }
            $task->order = ($order + 1);
        }
        else
        {
            $task->order = $request->order;
        }
        $task->save();
        return redirect()->route('task.index')->with('message','Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id)->delete();
        return redirect()->route('task.index')->with('message','Data deleted Successfully');
    }

    public function updateStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->status = $request->status;
        $task->save();
    }
}

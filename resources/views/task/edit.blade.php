@extends('layouts.site')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tasks</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tasks</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="col mt-3">
                            <a href="{{ route('task.index')}}" class="btn btn-primary mt-2"> <i class="fas fa-arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-2">
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                    @foreach($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                </div>
                @endif
                <div class="container-fluid">
                    <form action="{{ route('task.update',$task->id) }}" method="POST" class="formStyle">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4">{{ $task->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ date('Y-m-d',strtotime($task->date))}}">
                        </div>
                        <div class="form-group">
                            <label for="time">Start Time</label>
                            @if(is_null($task->start_time))
                            <input type="time" class="form-control" name="start_time" id="start_time" >
                            @else
                            <input type="time" class="form-control" name="start_time" id="start_time" value="{{ date('H:i',strtotime($task->start_time))}}">
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="time">End Time</label>
                            @if(is_null($task->end_time))
                            <input type="time" class="form-control" name="end_time" id="end_time">
                            @else
                            <input type="time" class="form-control" name="end_time" id="end_time" value="{{ date('H:i',strtotime($task->end_time))}}">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" class="form-control" name="order" id="order" value="{{ $task->order}}">
                        </div>
                        <input type="submit" value="Submit"  class="btn btn-dark btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

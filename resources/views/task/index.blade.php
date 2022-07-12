@extends('layouts.site')

@section('content')

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tasks</h3>
                        <ul class="breadcrumb" style="padding: 10px">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tasks</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="col mt-3">
                            <a href="{{ route('task.create')}}" class="btn btn-primary mt-2"> <i class="fas fa-plus"></i> Add Task</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table data-ordering="false" class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Order</th>
                                <th>Completed</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->date }}</td>
                                    <td>{{ $task->start_time }}</td>
                                    <td>{{ $task->end_time }}</td>
                                    <td>{{ $task->order }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input data-id="{{$task->id}}" class="form-check-input toggle-class" type="checkbox" id="switchDefault"  {{ $task->status ? 'checked' : ''}}>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('task.edit',$task->id)}}"><i class="far fa-edit"></i></a>
                                            </div>
                                       <div class="col">
                                        <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="deleteBtn"><i class="fas fa-trash text-danger"></i></button>
                                        </form>
                                    </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(function(){
        $('.toggle-class').change(function(){
            var status = $(this).prop('checked') == true ? 1 : 0;
            var task_id = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType:"json",
                url: "{{ route('task.status') }}",
                data: {_token: $('meta[name="csrf-token"]').attr('content'),'status':status, 'task_id':task_id},
                success:function(){
                    console.log('Success')
                }
            });
        });
    });
</script>
@endsection

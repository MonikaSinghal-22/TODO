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
                            <li class="breadcrumb-item active">Setting</li>
                        </ul>
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
                    <form action="{{ route('settingsave') }}" method="POST" class="formStyle">
                        @csrf
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="date">Confirm Password</label>
                            <input type="password" class="form-control" name="c_password" id="c_password">
                        </div>
                        <input type="submit" value="Submit"  class="btn btn-dark btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

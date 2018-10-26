@extends('layouts.app')

@section('content')
    <div class="container" data-aos="fade-down">
        <div class="page-header-admin">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
                </div>
            </div>
        </div>

        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>

            <div class="col-md-12">
                {!! Form::open(['action' => ['UsersController@password'],'method' => 'POST', 'files' => true]) !!}
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-4">
                            {{Form::label('current_password', 'Current Password')}}
                        </div>
                        <div class="col-md-8">
                            {{Form::password('current_password', ['class' => 'form-control','placeholder' => 'Current Password'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            {{Form::label('new_password', 'New Password')}}
                        </div>
                        <div class="col-md-8">
                            {{Form::password('new_password', ['class' => 'form-control','placeholder' => 'New Password'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            {{Form::label('confirm_new_password', 'Confirm New Password')}}
                        </div>
                        <div class="col-md-8">
                            {{Form::password('confirm_new_password', ['class' => 'form-control','placeholder' => 'Confirm New Password'])}}
                        </div>
                    </div>
                    <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
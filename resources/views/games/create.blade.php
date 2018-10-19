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
                    <li class="breadcrumb-item"><a href="/games">Games</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>

            {!! Form::open(['action' => 'GamesController@store','method' => 'POST', 'files' => true]) !!}
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('name', 'Name')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('name','',['class' => 'form-control','placeholder' => 'Name'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('description', 'Description')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('description','',['class' => 'form-control html-editor','placeholder' => 'Description','rows' => 2])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('logo', 'Logo')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('logo')}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('img', 'Image')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('img')}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('activity', 'Activity')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::checkbox('activity', 1, true)}}
                    </div>
                </div>
                <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
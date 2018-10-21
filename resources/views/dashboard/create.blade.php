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
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>

            {!! Form::open(['action' => 'DashboardController@store','method' => 'POST', 'files' => true]) !!}
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('title', 'Title')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
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
                        {{Form::label('game_id', 'Game')}}
                    </div>
                    <div class="col-md-8">
                        {!! Form::select('game_id', $games, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('video', 'Video')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('video')}}
                    </div>
                </div>
                <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
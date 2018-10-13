@extends('layouts.app')

@section('content')
    <div class="container">
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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/carousels">Carousels</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>

            {!! Form::open(['action' => 'CarouselsController@store','method' => 'POST']) !!}
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('caption', 'Caption')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('caption','',['class' => 'form-control','placeholder' => 'Caption','rows' => 1])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('subcaption', 'Subcaption')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('subcaption','',['class' => 'form-control html-editor','placeholder' => 'Subcaption','rows' => 2])}}
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
                {{Form::submit('Save',['class' => 'btn btn-primary btn-block'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
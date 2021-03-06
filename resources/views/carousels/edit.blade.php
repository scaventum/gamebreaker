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
                    <li class="breadcrumb-item"><a href="/carousels">Carousels</a></li>
                    <li class="breadcrumb-item"><a href="/carousels/{{$carousel->id}}">View - {{$carousel->id}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update - {{$carousel->id}}</li>
                </ol>
            </nav>

            {!! Form::open(['action' => ['CarouselsController@update', $carousel->id],'method' => 'POST', 'files' => true]) !!}
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('caption', 'Caption')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('caption', $carousel->caption, ['class' => 'form-control','placeholder' => 'Caption','rows' => 1])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('subcaption', 'Subcaption')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('subcaption', $carousel->subcaption, ['class' => 'form-control html-editor','placeholder' => 'Subcaption','rows' => 2])}}
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
                <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
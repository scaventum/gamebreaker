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
                    <li class="breadcrumb-item">Configuration</li>
            </ol>
        </nav>

        <div class="card-body">
            {!! Form::open(['action' => ['ConfigurationController@index'],'method' => 'POST', 'files' => true]) !!}
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('name', 'Name')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('name', $configuration->name, ['class' => 'form-control','placeholder' => 'Name'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('brand', 'Brand')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('brand', $configuration->brand, ['class' => 'form-control','placeholder' => 'Brand'])}}
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
                        {{Form::label('favicon', 'Favicon')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('favicon')}}
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('about_title', 'About Title')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('about_title', $configuration->about_title, ['class' => 'form-control','placeholder' => 'About Title'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('about_subtitle', 'About Subtitle')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('about_subtitle', $configuration->about_subtitle, ['class' => 'form-control','placeholder' => 'About Subtitle'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('about_img', 'About Image')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('about_img')}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('about_content', 'About Content')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::textarea('about_content', $configuration->about_content, ['class' => 'form-control html-editor','placeholder' => 'About Content','rows' => 2])}}
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('games_title', 'Games Title')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('games_title', $configuration->games_title, ['class' => 'form-control','placeholder' => 'Games Title'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('games_subtitle', 'Games Subtitle')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::text('games_subtitle', $configuration->games_subtitle, ['class' => 'form-control','placeholder' => 'Games Subtitle'])}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{Form::label('games_img', 'Games Image')}}
                    </div>
                    <div class="col-md-8">
                        {{Form::file('games_img')}}
                    </div>
                </div>

                <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
            {!! Form::close() !!}
            
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container" data-aos="fade-down">
        <div class="page-header-admin">
            <div class="row">
                <div class="col-8">
                    <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
                </div>
                <div class="col-4 text-right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/profile/password" class="btn btn-outline-light" title="Change Password"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4">
                    <div class="avatar-200 float-md-left mx-auto mb-3"
                    style="background:url({{asset('storage/img/avatars/'.$user->id.'.png')}}) center center no-repeat;background-size:cover;">
                    </div>
                    <div class="clearfix"></div>
                    <div class="float-md-left mx-auto mb-3 text-center">
                        {{$user->get_total_post($user->id)}} <i class='fas fa-film'></i>
                        &emsp;
                        {{$user->get_like_received($user->id)}} <i class="far fa-thumbs-up"></i>
                    </div>
                </div>
            
                <div class="col-md-8">
                    {!! Form::open(['action' => ['UsersController@profile'],'method' => 'POST', 'files' => true]) !!}
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-md-4">
                                {{Form::label('name', 'Name')}}
                            </div>
                            <div class="col-md-8">
                                {{Form::text('name', $user->name, ['class' => 'form-control','placeholder' => 'Name'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-4">
                                {{Form::label('email', 'E-mail')}}
                            </div>
                            <div class="col-md-8">
                                {{Form::email('email', $user->email, ['class' => 'form-control','placeholder' => 'E-mail', 'disabled'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                {{Form::label('avatar', 'Avatar')}}
                            </div>
                            <div class="col-md-8">
                                {{Form::file('avatar')}}
                            </div>
                        </div>
                        <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary btn-block"><i class="far fa-save"> </i> Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
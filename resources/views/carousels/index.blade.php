@extends('layouts.app')

@section('content')
    @include('inc.header_admin')
    <div class="container">
        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">Carousels</li>
                </ol>
            </nav>

            @if(count($carousels)>0)
                {{$carousels->links()}}
                @foreach($carousels as $carousel)
                    <div class="card card-body bg-light content-list">
                        <h5><a href="/carousels/{{$carousel->id}}">{{strip_tags($carousel->caption)}}</a></h5>
                        <small>Last update at {{date("d M Y H:i:s",strtotime($carousel->updated_at))}}</small>
                    </div>
                @endforeach
                {{$carousels->links()}}
            @endif
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<script>
$(document).ready(function() {
    $("#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();
} );
</script>

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
                    <li class="breadcrumb-item">Sort</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <div class="card bg-light">
                        <div class="card-header">
                            <i class='fas fa-toggle-on text-success'></i> Active 
                        </div>
                        <div class="card-body">
                            <ol id="sortable1" class="connectedSortable list-group">
                                @foreach($carousels_active as $carousel)
                                    <li class="ui-state-default list-group-item" data-id="{{$carousel->id}}"
                                    style="background:url({{asset('storage/img/carousels/'.$carousel['img'])}}) center center;background-size:cover;'>"    
                                    >   
                                        {!!$carousel->caption!!}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="card bg-light">
                        <div class="card-header">
                            <i class='fas fa-toggle-off text-danger'></i> Inactive
                        </div>
                        <div class="card-body">
                            <ol id="sortable2" class="connectedSortable list-group">
                                @foreach($carousels_inactive as $carousel)
                                    <li class="ui-state-default list-group-item" data-id="{{$carousel->id}}"
                                    style="background:url({{asset('storage/img/carousels/'.$carousel['img'])}}) center center;background-size:cover;'>">
                                        {!!$carousel->caption!!}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
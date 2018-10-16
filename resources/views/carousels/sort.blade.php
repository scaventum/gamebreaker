@extends('layouts.app')

@section('content')
<script>
$(document).ready(function() {
    var cache_active = $("#sortable_active").html();
    var cache_inactive = $("#sortable_inactive").html();

    var $currParent;
    $("#sortable_active, #sortable_inactive" ).sortable({
        connectWith: ".sortable_connected",
        start: function (event, ui) {
            $currParent = ui.item.parent();
        },
        stop: function (event, ui) {
            var name;
            if(ui.item.parent().attr('id')=="sortable_active"){
                name="id_active[]";
            }else if(ui.item.parent().attr('id')=="sortable_inactive"){
                name="id_inactive[]";
            }
            if(!ui.item.parent().is($currParent)) ui.item.find("input[type='hidden']").attr('name', name);
        }
    }).disableSelection();

    $("#btn_reset").click(function(){
        $("#sortable_active").html(cache_active).sortable("refresh");
        $("#sortable_inactive").html(cache_inactive).sortable("refresh");
    });
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
            {!! Form::open(['action' => ['CarouselsController@sort'],'method' => 'POST', 'files' => true]) !!}
                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                    <button id="sub_save" type="submit" name="sub_save" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                    <div id="btn_reset" name="btn_reset" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <div class="card bg-light">
                            <div class="card-header">
                                <i class='fas fa-toggle-on text-success'></i> Active 
                            </div>
                            <div class="card-body">
                                <ul id="sortable_active" class="sortable_connected list-group">
                                    @foreach($carousels_active as $carousel)
                                        <li class="ui-state-default list-group-item"
                                        style="background:url({{asset('storage/img/carousels/'.$carousel['img'])}}) center center;background-size:cover;"    
                                        >   
                                            {{Form::hidden('id_active[]', $carousel->id)}}
                                            {!!$carousel->caption!!}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <div class="card bg-light">
                            <div class="card-header">
                                <i class='fas fa-toggle-off text-danger'></i> Inactive
                            </div>
                            <div class="card-body">
                                <ul id="sortable_inactive" class="sortable_connected list-group">
                                    @foreach($carousels_inactive as $carousel)
                                        <li class="ui-state-default list-group-item"
                                        style="background:url({{asset('storage/img/carousels/'.$carousel['img'])}}) center center;background-size:cover;">
                                            {{Form::hidden('id_inactive[]', $carousel->id)}}
                                            {!!$carousel->caption!!}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')

    <script>
        $(document).ready( function () {

            var table_user = $('#table_user').DataTable( {
                "scrollX": true,
                "order": [[ 0, 'asc' ]],
                "pageLength": 10,
                "ajax": "/users/select_users",
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "role" }
                ],
                "columnDefs": [
                    { "orderable": false, "targets": 3 }
                ]
            });

            $('#table_user').on('change', 'select[name="role_id"]', function() {
                var id = $(this).attr('data-id');
                var role_id = $(this).val();
                if(confirm("Change role of user #"+id+"?"))
                {
                    $("#loading").show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "users/update_role",
                        data:{
                            id:id,
                            role_id:role_id
                        },

                        success: function(response) {
                            if($.isEmptyObject(response.error)){
                                table_user.ajax.reload(null,false);
                                alert(response.success);
                            }else{
                                alert(response.error);
                            }
                        }
                    });
                    $("#loading").hide(); 
                }
            });

        });
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
                    <li class="breadcrumb-item">Users</li>
                </ol>
            </nav>

            @if(count($users)>0)
            <table id="table_user" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
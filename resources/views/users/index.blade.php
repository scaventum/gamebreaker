@extends('layouts.app')

@section('content')

    <script>
        $(document).ready( function () {
            $('#table_user').DataTable({
                "scrollX": true
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
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->roles[0]->id!=1)
                                <select id="role_id" name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{($user->roles[0]->id==$role->id?"selected":"")}}>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @else
                                    {{$user->roles[0]->name}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
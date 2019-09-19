@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">

    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Roles</h6> <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                        <form method="POST" action="{{ route('rolesDestroy', $role->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


{!! $roles->render() !!}


@endsection

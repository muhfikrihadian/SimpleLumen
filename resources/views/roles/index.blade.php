@extends('layouts.app')


@section('content')
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
                    <h4 class="m-0 font-weight-bold text-primary">Roles Management</h4>
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
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit', Crypt::encryptString($role->id)) }}">Edit</a>
                            @endcan
                            @can('role-delete')
                            <form method="POST" action="{{ route('rolesDestroy', Crypt::encryptString($role->id)) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{!! $roles->render() !!}


@endsection

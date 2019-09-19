@extends('layouts.app')


@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <a class="btn btn-sm btn-primary" href="{{ route('roles.index') }}"> Back</a>
                </div>
                <div class="float-right">
                    <h4 class="m-0 font-weight-bold text-primary">Edit Role</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('roles.update', Crypt::encryptString($role->id)) }}">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <div class="card shadow mb-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            @foreach($segment as $key => $value)
                                            <th width="200"><center>{{ ucfirst($value->segment) }}</center></th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perment as $key => $value)
                                        <tr>
                                            <th>&nbsp;{{ ucfirst($key) }}</th>
                                            @foreach($value as $key => $value)
                                            <td>
                                                @if($value['check'] == 1)
                                                <center>
                                                    <input type="checkbox" name="permission[]" value="{{ $value['id'] }}" class="form-check-input" {{ in_array($value['id'], $rolePermissions) ? 'checked' : null }}>
                                                </center>
                                                @endif
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

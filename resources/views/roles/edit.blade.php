@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>


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

<form method="POST" action="{{ route('roles.update', $role->id) }}">
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
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($segment as $key => $value)
                            <th>{{ ucfirst($value->segment) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perment as $key => $value)
                        <tr>
                            <td>{{ ucfirst($key) }}</td>
                            @foreach($value as $key => $value)
                            <td>
                                @if($value['check'] == 1)
                                <input type="checkbox" name="permission[]" value="{{ $value['id'] }}" {{ in_array($value['id'], $rolePermissions) ? 'checked' : null }}>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

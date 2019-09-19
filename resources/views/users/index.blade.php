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
          <h4 class="m-0 font-weight-bold text-primary">Users Management</h4>
        </div>
        <div class="float-right">
          <a class="btn btn-sm btn-success" href="{{ route('users.create') }}"> Create New User</a>
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
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $key => $user)
          <tr>
            <th>{{ ++$i }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
              <label class="badge badge-success">{{ $v }}</label>
              @endforeach
              @endif
            </td>
            <td>
              <a class="btn btn-primary" href="{{ route('users.edit', Crypt::encryptString($user->id)) }}">Edit</a>
              <form method="POST" action="{{ route('usersDestroy', Crypt::encryptString($user->id)) }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{!! $data->render() !!}


@endsection

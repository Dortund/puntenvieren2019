@extends('layouts.app')

@section('content')
<div class="container">
	<div class="messages {{ session()->has('messages') ? 'visible' : 'invisible'}}">
		@if(session()->get('messages'))
			@foreach(session('messages') as $message)
        		<div class="alert alert-success">
        			{{ $message }}
        		</div>
        	@endforeach
		@endif
	</div>

	<div class="form-group row">
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.users.create') }}">{{ trans('admin/users.view.create') }}</a>
	</div>

	<h1>Users</h1>

	<table class="table">
		<thead>
	        <tr>
				<td>Name</td>
				<td>Party</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($users as $user)
	        <tr>
	            <td>{{$user->username}}</td>
	            <td>{{isset($user->party) ? $user->party->name : 'NONE'}}</td>
	            <td><a href="{{ route('admin.users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $users->links() }}
</div>
@endsection
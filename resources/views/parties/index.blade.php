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
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.parties.create') }}">{{ trans('admin/resources.view.create') }}</a>
	</div>

	<h1>Users</h1>

	<table class="table">
		<thead>
	        <tr>
				<td>Name</td>
				<td>Colour</td>
				<td>Avatar</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($parties as $party)
	        <tr>
	            <td>{{$party->name}}</td>
	            <td>{{$party->colour}}</td>
	            <td>{{$party->avatar}}</td>
	            <td><a href="{{ route('admin.parties.edit',$party->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $parties->links() }}
</div>
@endsection
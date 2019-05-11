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
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.votes.create') }}">{{ trans('admin/resources.view.create') }}</a>
	</div>

	<h1>Users</h1>

	<table class="table">
		<thead>
	        <tr>
				<td>Party</td>
				<td>Motion</td>
				<td>Vote</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($votes as $vote)
	        <tr>
	            <td>{{$vote->party->name}}</td>
	            <td>{{$vote->motion->text}}</td>
	            <td>{{$vote->vote_value}}</td>
	            <td><a href="{{ route('admin.votes.edit',$vote->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $votes->links() }}
</div>
@endsection
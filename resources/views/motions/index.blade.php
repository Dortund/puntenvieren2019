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
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.motions.create') }}">{{ trans('admin/resources.view.create') }}</a>
	</div>

	<h1>Motions</h1>

	<table class="table">
		<thead>
	        <tr>
	        	<td>ID</td>
				<td>Motion</td>
				<td>Time of Vote</td>
				<td>Vote Type</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($motions as $motion)
	        <tr>
	        	<td>{{$motion->id}}</td>
	            <td>{{$motion->text}}</td>
	            <td>{{$motion->time_of_vote}}</td>
	            <td>{{$motion->vote_value_type}}</td>
	            <td><a href="{{ route('admin.motions.edit',$motion->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $motions->links() }}
</div>
@endsection
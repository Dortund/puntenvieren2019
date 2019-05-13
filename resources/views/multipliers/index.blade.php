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
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.multipliers.create') }}">{{ trans('admin/resources.view.create') }}</a>
	</div>

	<h1>Multipliers</h1>

	<table class="table">
		<thead>
	        <tr>
        		<td>ID</td>
				<td>Product</td>
				<td>Value</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($multipliers as $multiplier)
	        <tr>
	            <td>{{$multiplier->id}}</td>
	            <td>{{$multiplier->product}}</td>
	            <td>{{$multiplier->value}}</td>
	            <td><a href="{{ route('admin.multipliers.edit',$multiplier->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $multipliers->links() }}
</div>
@endsection
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
		<a id="createBtn" class="btn btn-primary" href="{{ route('admin.seatmods.create') }}">{{ trans('admin/resources.view.create') }}</a>
	</div>

	<h1>Seat Modifiers</h1>

	<table class="table">
		<thead>
	        <tr>
				<td>Party</td>
				<td>Modifier</td>
				<td colspan="2">Action</td>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($seatmods as $seatmod)
	        <tr>
	            <td>{{$seatmod->party->name}}</td>
	            <td>{{$seatmod->modifier}}</td>
	            <td><a href="{{ route('admin.seatmods.edit',$seatmod->id)}}" class="btn btn-primary">Edit</a></td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	{{ $seatmods->links() }}
</div>
@endsection
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

	<h1>Uw Huidige Stem</h1>
	
	<div class="card">
		<div class="card-body">
			<div class="form-group row">
				<label for="motion_id" class="col-sm-4 col-form-label text-md-right">Motie:</label>

				<label class="col-md-6 col-form-label">
				@if (isset($motion))
					{{$motion->text}}
				@else
					Er zijn momenteel geen moties om over te stemmen
				@endif
				</label>
			</div>
			
			@if (isset($motion))
    			<div class="form-group row">
    				<label for="motion_id" class="col-sm-4 col-form-label text-md-right">Uw Stem:</label>
    
    				<label class="col-md-6 col-form-label">
    				@if (!isset($vote->vote_value))
    					{{ App\DefaultVote::find(2)->name }}
    				@else
    					@if ($vote->vote_value < 0)
    						{{ App\DefaultVote::find($vote->vote_value * -1)->name }}
    					@elseif ($motion->vote_value_type == 1)
    						@if ($vote->vote_value == 0)
    							{{ "Tegen" }}
    						@else
    							{{ "Voor" }}
    						@endif
    					@elseif ($motion->vote_value_type == 2)
    						{{ App\Party::find($vote->vote_value)->name }}
    					@endif
    				@endif
    				
    				</label>
    			</div>
			
    			<div class="form-group row mb-0">
    				<div class="col-md-8 offset-md-4">
    					<a href="{{ route('changeVote')}}" class="btn btn-primary">Aanpassen</a>
    				</div>
    			</div>
			@endif
		</div>
	</div>
</div>
@endsection
<?php
/*
 * Variables:
 * 1. $user - (optional) the user whose data should be preloaded in the form
 * 2. $route - the route to submit the form to
 * 3. $method - the method to submit: POST/GET/PUT
 * 4. $submitBtn - The text for the submit button
 */

use App\User;
?>
<div class="card">
	<div class="card-body">
		<form method="{{ (strtoupper($method) == 'GET') ? 'GET' : 'POST' }}" action="{{ $route }}">
		{{ csrf_field() }}
		{{ method_field($method) }}

			<div class="form-group row">
				<label for="text" class="col-sm-4 col-form-label text-md-right">Text</label>

				<div class="col-md-6">
					<input id="text" type="text" class="form-control @if($errors->has('text')) is-invalid @endif" name="text" value="{{ isset($motion) ? $motion->text : old('text') }}" required>

					@if ($errors->has('text'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('text') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group row">
				<label for="time_of_vote" class="col-sm-4 col-form-label text-md-right">Time of Vote</label>

				<div class="col-md-6">
					<input id="time_of_vote" type="datetime-local" class="date form-control @if($errors->has('time_of_vote')) is-invalid @endif" name="time_of_vote" value="{{ isset($motion) ? $motion->time_of_vote : old('time_of_vote') }}" required>

					@if ($errors->has('time_of_vote'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('time_of_vote') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group row">
				<label for="vote_value_type" class="col-sm-4 col-form-label text-md-right">Vote Value Type</label>

				<div class="col-md-6">
					<select id="vote_value_type" class="form-control @if($errors->has('vote_value_type')) is-invalid @endif" name="vote_value_type" required>
					@if (!isset($motion->vote_value_type))
						<option selected value="">No vote_value_type Selected</option>
					@endif
					
					@foreach(App\VoteValueType::all() as $type)
						<option
							value="{{$type->id}}"
							{{ isset($motion->vote_value_type) && $motion->vote_value_type == $type->id ? "selected" : "" }}>
							{{ $type->name }}
						</option>
					@endforeach
					</select>

					@if ($errors->has('vote_value_type'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('vote_value_type') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ $submitBtn }}
					</button>
				</div>
			</div>

		</form>

	</div>
</div>

<script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script>

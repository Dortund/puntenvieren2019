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
				<label for="motion_id" class="col-sm-4 col-form-label text-md-right">Motion</label>

				<div class="col-md-6">
					<select id="motion_id" class="form-control @if($errors->has('motion_id')) is-invalid @endif" name="motion_id" required autofocus>
					@if (!isset($vote->motion_id))
						<option selected value="">No Motion Selected</option>
					@endif
					
					@foreach(App\Motion::all() as $motion)
						<option
							value="{{$motion->id}}"
							{{ isset($vote->motion_id) && $vote->motion_id == $motion->id ? "selected" : "" }}>
							{{ $motion->text }}
						</option>
					@endforeach
					</select>

					@if ($errors->has('motion_id'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('motion_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="party_id" class="col-sm-4 col-form-label text-md-right">Party</label>

				<div class="col-md-6">
					<select id="party_id" class="form-control @if($errors->has('party_id')) is-invalid @endif" name="party_id" required>
					@if (!isset($vote->party_id))
						<option selected value="">No Party Selected</option>
					@endif
					
					@foreach(App\Party::all() as $party)
						<option
							value="{{$party->id}}"
							{{ isset($vote->party_id) && $vote->party_id == $party->id ? "selected" : "" }}>
							{{ $party->name }}
						</option>
					@endforeach
					</select>

					@if ($errors->has('party_id'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('party_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="vote_value" class="col-sm-4 col-form-label text-md-right">Vote Value</label>

				<div class="col-md-6">
					<select id="vote_value" class="form-control @if($errors->has('vote_value')) is-invalid @endif" name="vote_value" required>
					@if (!isset($vote->vote_value))
						<option selected value="">New Vote Being Made</option>
					@endif
					
					@foreach(App\DefaultVote::all() as $defVote)
						<option
							value="{{$defVote->value}}"
							{{ isset($vote->vote_value) && $vote->vote_value == $defVote->value ? "selected" : "" }}>
							{{ $defVote->name }}
						</option>
					@endforeach
					
						<option
							value="1"
							{{ $vote->vote_value === "1" ? "selected" : "" }}>
							Voor
						</option>
						<option
							value="0"
							{{ $vote->vote_value === "0" ? "selected" : "" }}>
							Tegen
						</option>
    					@foreach(App\Party::all() as $party)
    						<option
    							value="{{$party->id}}"
    							{{ isset($vote->vote_value) && $vote->vote_value == $party->id ? "selected" : "" }}>
    							{{ $party->name }}
    						</option>
    					@endforeach
					</select>

					@if ($errors->has('party_id'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('party_id') }}</strong>
						</span>
					@endif
					
					@if ($errors->has('vote_value'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('vote_value') }}</strong>
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

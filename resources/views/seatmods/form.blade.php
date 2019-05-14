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
				<label for="party_id" class="col-sm-4 col-form-label text-md-right">Party</label>

				<div class="col-md-6">
					<select id="party_id" class="form-control @if($errors->has('party_id')) is-invalid @endif" name="party_id" required>
					@if (!isset($seatmod->party_id))
						<option selected value="">No Party Selected</option>
					@endif
					
					@foreach(App\Party::all() as $party)
						<option
							value="{{$party->id}}"
							{{ isset($seatmod->party_id) && $seatmod->party_id == $party->id ? "selected" : "" }}>
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
				<label for="seatValue" class="col-sm-4 col-form-label text-md-right">Seat Value</label>

				<div class="col-md-6">
					<label for="seatValue" class="col-form-label text-md-left">{{ (isset($turnout->points) ? $turnout->points : 0) / 750}} points / Seat</label>
				</div>
			</div>

			<div class="form-group row">
				<label for="modifier" class="col-sm-4 col-form-label text-md-right">Modifier</label>

				<div class="col-md-6">
					<input id="modifier" type="number" step="0.01" max="999999" class="form-control @if($errors->has('modifier')) is-invalid @endif" name="modifier" value="{{ isset($seatmod) ? $seatmod->modifier : old('modifier') }}" required>

					@if ($errors->has('modifier'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('modifier') }}</strong>
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

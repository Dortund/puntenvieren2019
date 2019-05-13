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
				<label for="product" class="col-sm-4 col-form-label text-md-right">Product</label>

				<div class="col-md-6">
					<input id="product" type="text" class="form-control @if($errors->has('product')) is-invalid @endif" name="product" value="{{ isset($multiplier) ? $multiplier->product : old('product') }}" required>

					@if ($errors->has('product'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('product') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="value" class="col-sm-4 col-form-label text-md-right">Value</label>

				<div class="col-md-6">
					<input id="value" type="number" step="0.01" max="999999" class="form-control @if($errors->has('value')) is-invalid @endif" name="value" value="{{ isset($multiplier) ? $multiplier->value : old('value') }}" required>

					@if ($errors->has('value'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('value') }}</strong>
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

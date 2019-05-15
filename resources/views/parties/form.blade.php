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
		<form method="{{ (strtoupper($method) == 'GET') ? 'GET' : 'POST' }}" action="{{ $route }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field($method) }}

			<div class="form-group row">
				<label for="name" class="col-sm-4 col-form-label text-md-right">Receipt Name</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($party) ? $party->name : old('name') }}" required autofocus>

					@if ($errors->has('name'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="screenname" class="col-sm-4 col-form-label text-md-right">Screenname</label>

				<div class="col-md-6">
					<input id="screenname" type="text" class="form-control @if($errors->has('screenname')) is-invalid @endif" name="screenname" value="{{ isset($party) ? $party->screenname : old('screenname') }}" required>

					@if ($errors->has('screenname'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('screenname') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="colour" class="col-sm-4 col-form-label text-md-right">Colour</label>

				<div class="col-md-6">
					<input id="colour" type="color" class="form-control @if($errors->has('colour')) is-invalid @endif" name="colour" value="{{ isset($party) ? $party->colour : old('colour') }}">

					@if ($errors->has('colour'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('colour') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="form-group row">
				<label for="avatar" class="col-sm-4 col-form-label text-md-right">Avatar</label>

				<div class="col-md-6">
					@if (isset($party->avatar))
						<div class="avatar-wrapper mx-auto mb-3" style="width:300px">
							<img id="avatar-view" class="thumbnail" src="{{$party->avatar}}" title="avatar" style="width:300px;height:auto">
						</div>
					@endif
					<input id="avatar" type="file" class="form-control @if($errors->has('avatar')) is-invalid @endif" name="avatar" value="">

					@if ($errors->has('avatar'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('avatar') }}</strong>
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

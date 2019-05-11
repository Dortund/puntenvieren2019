@extends('layouts.app')
@section('content')

<h1> {{ trans('admin/resources.update.title') }}</h1>
  
@include('parties.form')

@endsection

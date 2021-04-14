@php
  use Tribe\Events\Views\V2\Template_Bootstrap;
@endphp

@extends('layouts.app')

@section('content')
  {!! tribe( Template_Bootstrap::class )->get_view_html(); !!}
@endsection


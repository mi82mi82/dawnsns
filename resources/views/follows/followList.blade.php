@extends('layouts.login')

@section('content')

@foreach
($timelines as $timelines)
  {{ $timelines->user_id }}
  {{ $timelines->post }}
@endforeach
@endsection
@extends('layouts.login')

@section('content')
{!! Form::open(['class' => ''],['url' => '/search']) !!}
        <div class="">
            {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
						<button type="submit" class="btn btn-success pull-right">検索</button>
        </div>
        {!! Form::close() !!}


@foreach($getUsers as $getUser)
<div>
<img src="images/{{$getUser->images}}">
{{$getUser->username}}
</div>
@endforeach

@endsection
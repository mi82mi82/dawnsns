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
<!-- もし、〇〇が自分でなかったら -->
@if($getUser->id != Auth::id())
@if($followings->contains($getUser->id))
<form action="/follow/create" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$getUser->id}}">
        <input type="submit" value="フォローする">
</form>

@else
<form action="/follow/delete" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$getUser->id}}">
        <input type="submit" value="フォロー外す">
</form>
@endif
@endif
@endforeach

@endsection
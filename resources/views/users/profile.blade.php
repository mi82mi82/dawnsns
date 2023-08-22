@extends('layouts.login')

@section('content')
{!! Form::open(['class' => ''],['url' => '/search']) !!}
<section id="contact">
    <div class="container">
      <div class="title">
        <h2></h2>
        <p class="ja-title"></p>
      </div>
      <form action="index.php" method="post">
        <div class="ct-block">
          <img src="/images/{{ $userimage }}">
          <label class="contact-text" for="name">UserName</label>
          <input type="text" name="Username" placeholder="Dawntown" class="form-name">
        </div>
        <div class="ct-block">
          <label class="contact-text" for="email">MailAdress</label>
          <input type="text" name="mail" placeholder="dawn@dawn.jp" class="form-mail">
        </div>
        <div class="ct-block">
				<label class="contact-text" for="email">Password</label>
          <input type="text" name="Password" placeholder="" class="form-Password" value="readonly属性で入力規制" readonly>
        </div>
				<label class="contact-text" for="new Password">new Password</label>
          <input type="text" name="new Password" placeholder="" class="form-new Password">
        </div>
        <div class="ct-block">
          <label for="request-about" class="contact-text">Bio</label>
          <textarea name="request-about" id="request-about" cols="60" rows="6" placeholder="自己紹介文（任意）"></textarea>
        </div>
        <div class="ct-block">
          <label for="request-about" class="contact-text">Iconimage</label>
          <textarea name="request-about" id="request-about" cols="60" rows="6">
          </textarea>
          <form method="POST" action="/upload" enctype="multipart/form-data">
            @csrf
             <input type="file" name="image">
          </form>
        </div>
        <div class="ct-block">
          <input class="send-button" type="submit" value="更新">
        </div>
      </form>
    </div>
  </section>

@endsection
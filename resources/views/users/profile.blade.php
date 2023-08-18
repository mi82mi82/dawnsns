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
          <label class="contact-text" for="name">UserName</label>
          <input type="text" name="yourname" placeholder="Dawntown" class="form-name">
        </div>
        <div class="ct-block">
          <label class="contact-text" for="email">MailAdress</label>
          <input type="text" name="mail" placeholder="dawn@dawn.jp" class="form-mail">
        </div>
        <div class="ct-block">
				<label class="contact-text" for="email">Password</label>
          <input type="text" name="mail" placeholder="" class="form-mail">
        </div>
				<label class="contact-text" for="email">new Password</label>
          <input type="text" name="mail" placeholder="" class="form-mail">
        </div>
        <div class="ct-block">
          <label for="request-about" class="contact-text">Bio</label>
          <textarea name="request-about" id="request-about" cols="60" rows="6" placeholder="自己紹介文（任意）"></textarea>
        </div>
        <div class="ct-block">
          <input class="send-button" type="submit" value="更新">
        </div>
      </form>
    </div>
  </section>

@endsection
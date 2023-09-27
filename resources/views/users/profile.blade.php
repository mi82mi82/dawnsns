@extends('layouts.login')

@section('content')

        <form method="POST" action="/upload" enctype="multipart/form-data">
          @csrf
          <div class="ct-block">
            <img src="/storage/images/{{ $userimage }}">
            <label class="contact-text" for="name">UserName</label>
            <input type="text" name="Username" value="{{ Auth::user()->username }}" class="form-name">
          </div>
          <div class="ct-block">
            <label class="contact-text" for="email">MailAdress</label>
            <input type="text" name="mail" value="{{ Auth::user()->mail }}"class="form-mail">
          </div>
          <div class="ct-block">
          <label class="contact-text" for="email">Password</label>
            <input type="password" name="Password"  class="form-Password" value="⚫︎⚫︎⚫︎⚫︎⚫︎⚫︎" readonly>
          </div>
          <label class="contact-text" for="newPassword">new Password</label>
            <input type="password" name="newPassword"  class="form-new Password">
          </div>
          <div class="ct-block">
            <label for="request-about" class="contact-text">Bio</label>
            <textarea name="bio" id="request-about" cols="60" rows="6">{{ Auth::user()->bio }}</textarea>
          </div>
          <div class="ct-block">
            <label for="request-about" class="contact-text">Iconimage</label>
            <input id="image" type="file" name="image">
          </div>
          <div class="ct-block">
            <input class="send-button" type="submit" value="更新">
          </div>
        </form>

@endsection
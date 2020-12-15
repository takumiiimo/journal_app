@extends('layouts.app')
@include('footer')

@section('content')
<div class="main">
    <div class="card card-devise">
        <div class="form-wrap">
            <div class="form-group text-center">
                <h4>Log in</h4>
                <p class="text-secondary">ログインする</p>
            </div>
            <form class="new_user" id="new_user" action="{{ route('login') }}" accept-charset="UTF-8" method="post">
                {{ csrf_field() }}
                <div class="form-item">
                    <input placeholder="Mail address" autocomplete="email" type="email" name="email" value="{{ old('email') }}" required/>
                </div>
                <div class="form-item">
                    <input placeholder="Password" autocomplete="off" type="password" name="password" required/>
                </div>
                <div class="button-panel">
                    <input type="submit" class="button" title="sign in" value="sign in" />
                </div>
            </form>
            <br>
            <div class="form-footer">
                <p><a href="{{ route('register') }}">アカウントをつくる</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
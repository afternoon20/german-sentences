@extends('_include.layout')

@section('content')
    <div class="container mb-5">
        <h3 class="center-align mb-5">ログイン</h3>
        @error('login_id')
            <div class="center-align red-text mb-3">{{ $message }}</div>
        @enderror
        @error('password')
            <div class="center-align red-text mb-3">{{ $message }}</div>
        @enderror
        <form class="row" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="s12 m2 l2"></div>
            <div class="s12 m8 l8 p-login p-5">
                <div class="row mb-5">
                    <div class="input-field col s12 mb-3 white">
                        <input id="login_id" type="text" name="login_id" class="validate white">
                        <label class="active" for="login_id">ログインID</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" class="validate white">
                        <label for="password">パスワード</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center">
                        <button type="submit" class="waves-effect btn">ログイン</button>
                    </div>
                </div>
            </div>
            <div class="s12 m2 l2"></div>
        </form>
    </div>
@endsection

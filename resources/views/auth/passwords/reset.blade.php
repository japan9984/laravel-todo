{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('パスワード再発行') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード（確認）') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('パスワード再設定') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<!-- saved from url=(0047)https://intern-3.stg.commude.biz/password/reset -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="{{ asset('/css/2-2_reissue_pass_files/styles.css') }}">
</head>
<body>
<header>
  <nav class="my-navbar">

        <a class="my-navbar-brand" href="/">ToDo App</a>
        <div class="my-navbar-control">
                  <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
            ｜
            <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
              </div>
      </nav>
</header>
<main>
    <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">パスワード再発行</div>
          <div class="panel-body">
            @if($errors->has('email') && $errors->has('password'))

            <div class="alert alert-danger mb-0">
                <p>メールアドレス は必須入力です。</p>
                <p>パスワード は必須入力です。</p>
            </div>

            @else
            @error('email')
            <div class="alert alert-danger mb-0">
                <p>メールアドレス は必須入力です。</p>
            </div>
            @enderror
            @error('password')
                <div class="alert alert-danger mb-0">
                    <p>パスワード は必須入力です。</p>
                </div>
            @enderror
            @endif
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">再発行リンクを送る</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>



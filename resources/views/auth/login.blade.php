{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-12">
                            <label for="email" class="col-md-4 col-form-label">{{ __('メールアドレス') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-12">
                            <label for="password" class="col-md-4 col-form-label">{{ __('パスワード') }}</label>


                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 ">
                            <div class="col-md-8 offset-md-4 mt-4 text-md-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('送信') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (Route::has('password.request'))
            <a class="btn btn-link text-decoration-none mt-2" href="{{ route('password.request') }}">
                {{ __('パスワードの変更はこちらから') }}
            </a>
        @endif
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<!-- saved from url=(0038)https://intern-3.stg.commude.biz/login -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="{{asset('/css/1_login_files/styles.css')}}">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="https://intern-3.stg.commude.biz/">ToDo App</a>
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
          <div class="panel-heading">ログイン</div>
          <div class="panel-body">
                          <div class="alert alert-danger">
                                  <p>メールアドレス は必須入力です。</p>
                                  <p>パスワード は必須入力です。</p>
                              </div>
                              <form method="POST" action="{{ route('login') }}">
                                @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="">
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center">
          <a href="http://intern-3.stg.commude.biz/password/reset">パスワードの変更はこちらから</a>
        </div>
      </div>
    </div>
  </div>
</main>


</body></html>

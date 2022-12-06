{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('会員登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-md-4 col-form-label">{{ __('ユーザー名') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('メールアドレス') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('パスワード') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('パスワード（確認）') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('送信') }}
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
<!-- saved from url=(0041)https://intern-3.stg.commude.biz/register -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="{{asset('/css/3_register_files/styles.css')}}">
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
          </div>
  </nav>
</header>
<main>
    <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">会員登録</div>
          <div class="panel-body">
            @if($errors->has('email') && $errors->has('name') && $errors->has('password'))
            <div class="alert alert-danger mb-0">
                <p>ユーザー名 は必須入力です。</p>
                <p>メールアドレス は必須入力です。</p>
                <p>パスワード は必須入力です。</p>
            </div>
            @elseif($errors->has('email') && $errors->has('name'))
            <div class="alert alert-danger mb-0">
            <p>ユーザー名 は必須入力です。</p>
            <p>メールアドレス は必須入力です。</p>
            </div>
            @elseif($errors->has('email') && $errors->has('password'))
            <div class="alert alert-danger mb-0">
            <p>メールアドレス は必須入力です。</p>
            <p>パスワード は必須入力です。</p>
            </div>
            @elseif($errors->has('name') && $errors->has('password'))
            <div class="alert alert-danger mb-0">
            <p>ユーザー名 は必須入力です。</p>
            <p>パスワード は必須入力です。</p>
            </div>
            @else
            @error('name')
            <div class="alert alert-danger mb-0">
                <p>ユーザー名 は必須入力です。</p>
            </div>
            @enderror
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
             <form method="POST" action="{{ route('register') }}">
                @csrf
              {{-- <input type="hidden" name="_token" value="LDRHeyJYemuzXpLylyuRRH0L3vbhLBJzqf3NNMYZ"> --}}
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email"value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
</main>


</body></html>

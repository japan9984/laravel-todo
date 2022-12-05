@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('タスクを編集する') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('memo.update') }}">
                        @csrf
                        <input type="hidden" name="memo_id" value="{{ $edit_memo['id'] }}">
                        <div class="mb-12">
                            <label for="content" class="col-md-4 col-form-label">{{ __('タイトル') }}</label>

                            <div class="col-md-12">
                                <input id="content" class="form-control" name="content" required autofocus value="{{ $edit_memo['content'] }}">

                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        {{-- <div class="mb-12">
                            <label for="content" class="col-md-4 col-form-label">{{ __('状態') }}</label>

                            <div class="col-md-12">
                                <input id="content" class="form-control" name="content" required autofocus value="{{ $edit_memo['content'] }}">

                            </div>
                        </div> --}}

                        <div class="mb-12">
                            <label for="deadline" class="col-md-4 col-form-label">{{ __('期限') }}</label>

                            <div class="col-md-12">
                                <input id="deadline" type="date" class="form-control" name="deadline" required value="{{ $edit_memo['deadline'] }}">

                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                         {{-- <div class="row mb-3">
                           <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

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
    </div>
</div>
@endsection

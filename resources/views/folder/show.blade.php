@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">フォルダ</div>
                <div class="card-body">
                    <a href="{{ route('folder.create') }}">
                    <button type="button" class="btn btn-outline-secondary col-md-12">
                        フォルダを追加する
                    </button>
                    </a>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($folders as $folder)
                           {{-- <a href="/?folder={{ $folder['id'] }}" class="col-8 mt-3 d-block">{{ $folder['folder'] }}</a> --}}
                           <a href="/folder/show/{{ $folder['id'] }}" class="col-8 mt-3 d-block">{{ $folder['folder'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">タスク</div>
                <div class="card-body">
                    <a href="{{ route('memo.create', ['folder_id' => $folder_id]) }}">
                    <button type="button" class="btn btn-outline-secondary col-md-12">
                        タスクを追加する
                    </button>
                    </a>
                    {{-- @foreach($memos as $memo)
                    <div class="d-block row mt-3 ">
                        <a href="/memo/edit/{{$memo['id']}}" class="col-8">{{ $memo['content'] }}</a>
                        <a href="/memo/edit/{{$memo['id']}}" class="col-4">{{ $memo['deadline'] }}</a>
                    </div>
                    @endforeach --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

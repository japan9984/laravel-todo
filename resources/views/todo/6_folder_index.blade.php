<!DOCTYPE html>
<!-- saved from url=(0048)https://intern-3.stg.commude.biz/folders/1/tasks -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="{{ asset('/css/6_folder_index_files/styles.css') }}">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="https://intern-3.stg.commude.biz/">ToDo App</a>
    <div class="my-navbar-control">
              <span class="my-navbar-item">ようこそ, test999さん</span>
        ｜
        <a href="https://intern-3.stg.commude.biz/folders/1/tasks#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="http://intern-3.stg.commude.biz/logout" method="POST" style="display: none;">
          <input type="hidden" name="_token" value="LDmFpir3LMnHmCLbjpI6ffaNDtM5ev1ag2ys3hVF">        </form>
          </div>
  </nav>
</header>
<main>
    <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('todo.folder_create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
             {{-- <a href="" class="list-group-item active">
                test
              </a> --}}
              @foreach($folders as $folder)

              {{-- <a href="/todo/folder_index/?folder={{ $folder['id'] }}" class="list-group-item">{{ $folder['folder'] }}</a> --}}
              <a href="/todo/folder_show/{{ $folder['id'] }}" class="list-group-item">{{ $folder['folder'] }}</a>
              {{-- <a href="{{ route('folder.show', $folder['id']) }}" class="col-8 mt-3 d-block">{{ $folder['folder'] }}</a> --}}
              @endforeach
                      </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          {{-- <div class="panel-body">
            <div class="text-right">
              <a href="/todo/task_create/{{ $folder['id'] }}" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div> --}}
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
            @foreach($memos as $memo)
            <div class="d-block row mt-3 ">

                <tr>
                    <th>  <a href="/todo/task_edit/{{$memo['id']}}">{{ $memo['content'] }}   </a></th>
                    <th>{{ $memo['status'] }}</th>
                    <th>{{ $memo['deadline'] }}</th>
                    <th></th>
                </tr>

            </div>
            @endforeach

            </thead>
            <tbody>
                        </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>


</body></html>

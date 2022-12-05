<!DOCTYPE html>
<!-- saved from url=(0047)https://intern-3.stg.commude.biz/folders/create -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="{{ asset('css/5_folder_Create_files/styles.css') }}">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="https://intern-3.stg.commude.biz/">ToDo App</a>
    <div class="my-navbar-control">
              <span class="my-navbar-item">ようこそ, test999さん</span>
        ｜
        <a href="https://intern-3.stg.commude.biz/folders/create#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="http://intern-3.stg.commude.biz/logout" method="POST" style="display: none;">
          <input type="hidden" name="_token" value="LDmFpir3LMnHmCLbjpI6ffaNDtM5ev1ag2ys3hVF">        </form>
          </div>
         
  </nav>

</header>
<main>
    <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダを追加する</div>
          <div class="panel-body">
                          <div class="alert alert-danger">
                                  <p>フォルダ名 は必須入力です。</p>
                              </div>
                        <form action="{{ route('todo.folder_store') }}" method="post">
                            @csrf
                 <div class="form-group">
                <label for="title">フォルダ名</label>
                <input type="text" class="form-control" name="title" id="title" value="">
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
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>


</body></html>

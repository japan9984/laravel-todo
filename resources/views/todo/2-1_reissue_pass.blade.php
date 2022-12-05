<!DOCTYPE html>
<!-- saved from url=(0047)https://intern-3.stg.commude.biz/password/reset -->
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
    <link rel="stylesheet" href="./2-1_reissue_pass_files/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="https://intern-3.stg.commude.biz/">ToDo App</a>
    <div class="my-navbar-control">
              <a class="my-navbar-item" href="http://intern-3.stg.commude.biz/login">ログイン</a>
        ｜
        <a class="my-navbar-item" href="http://intern-3.stg.commude.biz/register">会員登録</a>
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
                                      <div class="alert alert-danger">
                                  <p>メールアドレス は必須入力です。</p>
                              </div>
                        <form action="http://intern-3.stg.commude.biz/password/email" method="POST">
              <input type="hidden" name="_token" value="LDRHeyJYemuzXpLylyuRRH0L3vbhLBJzqf3NNMYZ">              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email">
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
</main>


</body></html>

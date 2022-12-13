<!DOCTYPE html>
<!-- saved from url=(0055)https://intern-3.stg.commude.biz/folders/1/tasks/create -->
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    <link rel="stylesheet" href="{{ asset('/css/7_task_create_files/flatpickr.min.css') }}">
    <link rel="stylesheet" href=".{{ asset('/css/7_task_create_files/material_blue.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/7_task_create_files/styles.css') }}">
</head>

<body  style="background-image: url('{{ asset($bg_path) }}')">
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/">ToDo App</a>
            <div class="my-navbar-control">
                <a href="{{ route('csv') }}">
                    <button>csvダウンロード</button>
                </a>
                <a href="{{ route('bg.create') }}">
                    <button>背景画像設定</button>
                </a>
                <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
                ｜
                <a href="/" id="logout" class="my-navbar-item">ログアウト</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
    </header>
    <main>

        <div class="container">
            <div class="row">
                <div class="col col-md-offset-3 col-md-6">
                    <nav class="panel panel-default">
                        <div class="panel-heading">タスクを追加する</div>
                        <div class="panel-body">
                            <form action="{{ route('memo.store', $folder) }}" method="POST"
                                enctype='multipart/form-data'>
                                @csrf
                                @if($errors->has('title') && $errors->has('deadline'))

                                <div class="alert alert-danger mb-0">
                                    <p>タイトル は必須入力です。</p>
                                    <p>期限日 は必須入力です。</p>
                                </div>

                                @else
                                @error('title')
                                <div class="alert alert-danger mb-0">
                                    <p>タイトル は必須入力です。</p>
                                </div>
                                @enderror
                                @error('deadline')
                                <div class="alert alert-danger mb-0">
                                    <p>期限日 は必須入力です。</p>
                                </div>
                                @enderror
                                @endif

                                <input type="hidden" name="status" value="1">
                                {{-- <input type="hidden" value="{{ ($folder->id) }}" name="folder_id"> --}}
                                <div class="form-group">
                                    <label for="title">タイトル</label>
                                    <input type="text" class="form-control" name="title" id="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="image">画像</label>
                                    <input id="image" type="file" name="image" style="margin-bottom: 10px;">
                                </div>

                                <div class="form-group">
                                    <label for="deadline">期限</label>
                                    <input id="deadline" type="date" class="form-control flatpickr-input"
                                        name="deadline">
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
    <script src="{{ asset('/css/7_task_create_files/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/css/7_task_create_files/ja.js') }}"></script>
    <script>
        flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
    </script>
    <div class="flatpickr-calendar animate" tabindex="-1">
        <div class="flatpickr-months"><span class="flatpickr-prev-month flatpickr-disabled"><svg version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
                    <g></g>
                    <path d="M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z">
                    </path>
                </svg></span>
            <div class="flatpickr-month">
                <div class="flatpickr-current-month"><select class="flatpickr-monthDropdown-months" aria-label="月"
                        tabindex="-1">
                        <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1">4月</option>
                        <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1">5月</option>
                        <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1">6月</option>
                        <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1">7月</option>
                        <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1">8月</option>
                        <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1">9月</option>
                        <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1">10月</option>
                        <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1">11月</option>
                        <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1">12月</option>
                    </select>
                    <div class="numInputWrapper"><input class="numInput cur-year" type="number" tabindex="-1"
                            aria-label="年" min="2022"><span class="arrowUp"></span><span class="arrowDown"></span></div>
                </div>
            </div><span class="flatpickr-next-month"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
                    <g></g>
                    <path d="M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z">
                    </path>
                </svg></span>
        </div>
        <div class="flatpickr-innerContainer">
            <div class="flatpickr-rContainer">
                <div class="flatpickr-weekdays">
                    <div class="flatpickr-weekdaycontainer">
                        <span class="flatpickr-weekday">
                            日</span><span class="flatpickr-weekday">月</span><span
                            class="flatpickr-weekday">火</span><span class="flatpickr-weekday">水</span><span
                            class="flatpickr-weekday">木</span><span class="flatpickr-weekday">金</span><span
                            class="flatpickr-weekday">土
                        </span>
                    </div>
                </div>
                <div class="flatpickr-days" tabindex="-1">
                    <div class="dayContainer"><span class="flatpickr-day prevMonthDay flatpickr-disabled"
                            aria-label="3月 27, 2022">27</span><span
                            class="flatpickr-day prevMonthDay flatpickr-disabled"
                            aria-label="3月 28, 2022">28</span><span
                            class="flatpickr-day prevMonthDay flatpickr-disabled"
                            aria-label="3月 29, 2022">29</span><span
                            class="flatpickr-day prevMonthDay flatpickr-disabled"
                            aria-label="3月 30, 2022">30</span><span
                            class="flatpickr-day prevMonthDay flatpickr-disabled"
                            aria-label="3月 31, 2022">31</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 1, 2022">1</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 2, 2022">2</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 3, 2022">3</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 4, 2022">4</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 5, 2022">5</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 6, 2022">6</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 7, 2022">7</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 8, 2022">8</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 9, 2022">9</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 10, 2022">10</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 11, 2022">11</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 12, 2022">12</span><span class="flatpickr-day flatpickr-disabled"
                            aria-label="4月 13, 2022">13</span><span class="flatpickr-day today" aria-label="4月 14, 2022"
                            aria-current="date" tabindex="-1">14</span><span class="flatpickr-day"
                            aria-label="4月 15, 2022" tabindex="-1">15</span><span class="flatpickr-day"
                            aria-label="4月 16, 2022" tabindex="-1">16</span><span class="flatpickr-day"
                            aria-label="4月 17, 2022" tabindex="-1">17</span><span class="flatpickr-day"
                            aria-label="4月 18, 2022" tabindex="-1">18</span><span class="flatpickr-day"
                            aria-label="4月 19, 2022" tabindex="-1">19</span><span class="flatpickr-day"
                            aria-label="4月 20, 2022" tabindex="-1">20</span><span class="flatpickr-day"
                            aria-label="4月 21, 2022" tabindex="-1">21</span><span class="flatpickr-day"
                            aria-label="4月 22, 2022" tabindex="-1">22</span><span class="flatpickr-day"
                            aria-label="4月 23, 2022" tabindex="-1">23</span><span class="flatpickr-day"
                            aria-label="4月 24, 2022" tabindex="-1">24</span><span class="flatpickr-day"
                            aria-label="4月 25, 2022" tabindex="-1">25</span><span class="flatpickr-day"
                            aria-label="4月 26, 2022" tabindex="-1">26</span><span class="flatpickr-day"
                            aria-label="4月 27, 2022" tabindex="-1">27</span><span class="flatpickr-day"
                            aria-label="4月 28, 2022" tabindex="-1">28</span><span class="flatpickr-day"
                            aria-label="4月 29, 2022" tabindex="-1">29</span><span class="flatpickr-day"
                            aria-label="4月 30, 2022" tabindex="-1">30</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 1, 2022" tabindex="-1">1</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 2, 2022" tabindex="-1">2</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 3, 2022" tabindex="-1">3</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 4, 2022" tabindex="-1">4</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 5, 2022" tabindex="-1">5</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 6, 2022" tabindex="-1">6</span><span class="flatpickr-day nextMonthDay"
                            aria-label="5月 7, 2022" tabindex="-1">7</span></div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

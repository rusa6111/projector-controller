<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>projector controller</title>
    <style media="screen">
      body {
        padding-top: 90px; /* ヘッダーの後ろに要素が隠れないようにするため */
      }

      header {
        width: 100%; /* 幅いっぱいを指定 */
        height: 50px; /* 高さを50pxに指定 */
        background: #FFF; /* 背景色にグレーを指定 */
        box-shadow: 0 -3px 10px #0008;
        padding: 20px 4vw; /* ヘッダーに上下左右それぞれ余白を指定 */
        box-sizing: border-box; /* padding分を含んで幅を100%にするため */
        position: fixed; /* ウィンドウを基準に画面に固定 */
        top: 0; /* 上下の固定位置を上から0pxにする */
        left: 0; /* 左右の固定位置を左から0pxにする */
        display: flex; /* 中の要素を横並びにする */
        align-items: center; /* 中の要素を上下中央に並べる */
      }
      
      .header-container h2 {
        display: inline-block;
        margin: 10px 0px;
      }
      
      .header-container .title {
        text-decoration: none;
        color: #000;
        transition: color 0.3s;
      }
      
      .header-container .title:hover {
        color: #888;
      }
      
      .header-container .btn-group {
        margin-left: 70px;
        margin-top: -10px;
      }
      
      .header-container .btn-group .btn {
        
        margin-left: 18px !important;
      }
      
    </style>
    @section('style')
    @show
  </head>
  <body>
    <header>
      <div class="container">
        <div class="row">
          <div class="sm-col-12 md-col-8 header-container">
            <a class="title" href="{{ route('home') }}"><h2>Projector Controller</h2></a>
            <div class="btn-group" role="group">
              <a href="{{ route('player') }}" role="button" class="btn btn-secondary rounded-pill">Player</a>
              <a href="{{ route('control') }}" role="button" class="btn btn-secondary rounded-pill">Controller</a>
              <a href="{{ route('add') }}" role="button" class="btn btn-secondary rounded-pill">Manage</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    
    <main>
      <div class="container">
        <div class="row">
          <div class="sm-col-12 md-col-8">
            @section('content')
            @show
          </div>
        </div>
      </div>
    </main>
  </body>
  
  @section('script')
  @show
</html>
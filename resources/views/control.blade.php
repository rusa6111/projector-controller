@extends('layouts')
@section('style')
<style media="screen">
  .invisible {
    height: 0;
  }
  .footer-blank {
    height: 100px;
    x-index: -999999;
  }
  .footer {
    height: 80px;
    width: 100%;
    box-shadow: 0 3px 10px #0008;
    background: #fff;
    padding: 20px 4vw; /* ヘッダーに上下左右それぞれ余白を指定 */
    box-sizing: border-box; /* padding分を含んで幅を100%にするため */
    position: fixed; /* ウィンドウを基準に画面に固定 */
    bottom: 0; /* 上下の固定位置を上から0pxにする */
    left: 0; /* 左右の固定位置を左から0pxにする */
    display: flex; /* 中の要素を横並びにする */
    align-items: center; /* 中の要素を上下中央に並べる */
    z-index: 99999999;
  }
  .footer-container {
    display: flex;
    align-items: center;
  }
  .footer-title {
    margin-bottom: 0;
    margin-right: 30px;
  }
  .input-group input {
    width: 100px;
    margin-right: 40px;
  }
</style>
@endsection
@section('content')
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<h1>Controller</h1>
@foreach ($movies as $movie)
<div>
  <h2>{{ $movie->title }}</h2>
  <div>
    <input id="title" name="title" type="hidden" value="{{ $movie->title }}">
    <button type="submit" class="btn btn-primary" id="button-{{ $movie->title }}-A">Player A</button>
    <button type="submit" class="btn btn-primary" id="button-{{ $movie->title }}-B">Player B</button>
    <button type="submit" class="btn btn-primary" id="button-{{ $movie->title }}-C">Player C</button>
    <button type="button" id="preview-{{ $movie->title }}" class="btn btn-secondary">Preview</button>
  </div>
  <video preload="auto" id="video-{{ $movie->title }}" controls width="750" class="invisible">
    <source src="{{ asset('storage/' . $movie->path) }}" type="video/mp4">
  </video>
</div>
@endforeach
<div class="footer-blank"></div>
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="sm-col-12 md-col-12">
        <form action="{{ route('play') }}" method="post" class="footer-container">
          @csrf
          <div class="input-group">
            <span class="input-group-text"><span class="d-none d-xl-inline">Player </span>A</span>
            <input type="text" id="titleA" name="titleA" class="form-control">
          </div>
          <div class="input-group">
            <span class="input-group-text"><span class="d-none d-xl-inline">Player </span>B</span>
            <input type="text" id="titleB" name="titleB" class="form-control">
          </div>
          <div class="input-group">
            <span class="input-group-text"><span class="d-none d-xl-inline">Player </span>C</span>
            <input type="text" id="titleC" name="titleC" class="form-control">
          </div>
          <button type="submit" class="btn btn-success">Play</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  var titleA = document.getElementById("titleA");
  var titleB = document.getElementById("titleB");
  var titleC = document.getElementById("titleC");
  
  @foreach ($movies as $movie)
    document.getElementById("button-{{ $movie->title }}-A").onclick = function () {
      titleA.value = "{{ $movie->title }}";
    }
    document.getElementById("button-{{ $movie->title }}-B").onclick = function () {
      titleB.value = "{{ $movie->title }}";
    }
    document.getElementById("button-{{ $movie->title }}-C").onclick = function () {
      titleC.value = "{{ $movie->title }}";
    }
    
    document.getElementById("preview-{{ $movie->title }}").onclick = function () {
      var video = document.getElementById("video-{{ $movie->title }}");
      if (video.classList.contains('invisible')) {
        video.classList.remove('invisible');
      } else {
        video.classList.add('invisible');
      }
    }
  @endforeach
</script>

@endsection
  

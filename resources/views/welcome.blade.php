@extends('layouts')
@section('style')
<style media="screen">
  .link-btn {
    margin: 5px 20px;
  }
</style>
@endsection

@section('content')
  <h1>Main Panel</h1>
  <h2>Player</h2>
  <p>
    <a href="{{ route('player') }}"><button type="button" class="btn btn-primary link-btn">Player</button></a>
    プロジェクターに投影するための機器を接続します
  </p>
  
  <h2>Controller</h2>
  <p>
    <a href="{{ route('control') }}"><button type="button" class="btn btn-success link-btn">Controller</button></a>
    Playerの制御用機器を接続します
  </p>
  <p>
    <a href="{{ route('add') }}"><button type="button" class="btn btn-success link-btn">Manage</button></a>
    再生する映像を登録します
  </p>
@endsection
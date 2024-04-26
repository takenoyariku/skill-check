@extends('common.layout')

@section('title', '新規作成ページ')
@section('style')
  @vite(['resources/scss/diary/create.scss'])
@endsection

@section('content')
  <div class="l-main">
    <h1>新規作成</h1>
    <form action="{{ route('diary.store') }}" enctype="multipart/form-data">
      @csrf
      <table>
        <tbody>
          <tr>
            <th>
              <label for="image">サムネイル画像</label>
            </th>
            <td>
              <input id="image" type="file" name="image" accept=".jpg, .jpeg">
              <p>※jpgのみアップロード可能です</p>
            </td>
          </tr>
          <tr>
            <th>
              <label for="content">本文</label>
            </th>
            <td>
              <input id="content" type="text">
            </td>
          </tr>
        </tbody>
      </table>
      <button type="submit">登録する</button>
    </form>
  </div>
@endsection
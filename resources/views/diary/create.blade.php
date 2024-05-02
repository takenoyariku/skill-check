@extends('common.layout')

@section('title', '新規作成ページ')
@section('style')
  @vite(['resources/scss/diary/create.scss'])
@endsection

@section('content')
  <div class="l-main">
    <h1>新規作成</h1>
    <form action="{{ route('diary.store') }}" method="POST" enctype="multipart/form-data">
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
              <label for="comment">本文</label>
            </th>
            <td>
              <input id="comment" type="text" name="comment" value="{{ old('comment') }}">
              <p>※200文字以内で入力してください</p>
            </td>
          </tr>
        </tbody>
      </table>
      <button type="submit">登録する</button>
    </form>
  </div>
@endsection
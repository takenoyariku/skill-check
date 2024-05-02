@extends('common.layout')

@section('title', '編集ページ')
@section('style')
  @vite(['resources/scss/diary/edit.scss'])
@endsection

@section('content')
  <div class="l-main">
    <h1>編集</h1>
    <form action="{{ route('diary.update', ['id' =>  $diary->id]) }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <table>
        <tbody>
          <tr>
            <th>
              <label for="image">サムネイル画像</label>
            </th>
            <td>
              <div class="input-image">
                <input id="image" type="file" name="image" accept=".jpg, .jpeg">
                <p>※jpgのみアップロード可能です</p>
              </div>
              <div class="old-image">
                <p>現在の画像</p>
                <img src="{{ asset('storage/uploads/'.$diary->image_path) }}" alt="">
              </div>
            </td>
          </tr>
          <tr>
            <th>
              <label for="">本文</label>
            </th>
            <td>
              <input id="comment" type="text" name="comment" value="{{ old('comment', $diary->comment) }}">
              <p>※200文字以内で入力してください</p>
            </td>
          </tr>
        </tbody>
      </table>
      <button type="submit">更新する</button>
    </form>
  </div>
@endsection
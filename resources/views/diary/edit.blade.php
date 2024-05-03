@extends('common.layout')

@section('title', '編集ページ')
@section('style')
  @vite(['resources/scss/diary/edit.scss'])
@endsection
@section('js')
  @vite(['resources/js/file.js'])
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
                @error('image')
                  <p class="error">{{ $message }}</p>
                @enderror
              </div>
              <div class="old-image">
                <p>現在の画像</p>
                @if($diary->image_path)
                  <img src="{{ asset('storage/uploads/'.$diary->image_path) }}" alt="">
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <th class="required">
              <label for="">本文</label>
            </th>
            <td>
              <input id="comment" type="text" name="comment" value="{{ old('comment', $diary->comment) }}">
              <p>※200文字以内で入力してください</p>
              @error('comment')
                <p class="error">{{ $message }}</p>
              @enderror
            </td>
          </tr>
        </tbody>
      </table>
      <div class="btn-area">
        <a href="{{ route('index') }}">一覧へ戻る</a>
        <button type="submit">更新する</button>
      </div>
    </form>
  </div>
@endsection
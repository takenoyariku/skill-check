@extends('common.layout')

@section('title', '一覧ページ')
@section('style')
  @vite(['resources/scss/index.scss'])
@endsection

@section('content')
  <div class="l-main">
    <div class="column">
      <h1>日記一覧</h1>
      <a href="{{ route('diary.create') }}">新規作成</a>
    </div>

    <table>
      <tbody>
        <tr>
          <th>サムネイル画像</th>
          <th>本文</th>
          <th>操作</th>
        </tr>
        @for($i=0; $i<5; $i++)
        <tr>
          <td><img src="{{ asset('img/dog.webp') }}" alt=""></td>
          <td>コメントコメントコメントコメントコメント</td>
          <td>
            <a href="{{ route('diary.edit', ['id' => 1]) }}">編集する</a>
            <form action="{{ route('diary.destroy', ['id' => 1]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('削除してもよろしいですか？')">削除</button>
            </form>
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
@endsection
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
        @foreach($diaries as $item)
        <tr>
          <td>
            @if($item->image_path)
              <img src="{{ asset('storage/uploads/'.$item->image_path) }}" alt="">
            @endif
          </td>
          <td>{{ $item->comment }}</td>
          <td>
            <a href="{{ route('diary.edit', ['id' => $item->id]) }}">編集する</a>
            <form action="{{ route('diary.destroy', ['id' => $item->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('削除してもよろしいですか？')">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $diaries->links('pagination.custom') }}

    @if(session('error_message'))
      <div class="message error-message">
        {{ session('error_message') }}
      </div>
    @elseif(session('success_message'))
      <div class="message success-message">
        {{ session('success_message') }}
      </div>
    @endif
  </div>
@endsection
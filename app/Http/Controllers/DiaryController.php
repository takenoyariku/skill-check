<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DiaryController extends Controller
{
  /**
   * 一覧ページ 表示
   */
  public function index(): View
  {
    $diaries = app()->make('get_diary')->getDiary();
    return view('index', compact('diaries'));
  }

  /**
   * 新規作成ページ 表示
   */
  public function create(): View
  {
    return view('diary.create');
  }

  /**
   * 新規作成機能
   */
  public function store(Request $request): RedirectResponse
  {
    app()->make('create_diary')->createDiary($request);
    return to_route('index');
  }

  /**
   * 更新ページ 表示
   * @param int $id 日記ID
   */
  public function edit(int $id): View
  {
    $diary = Diary::find($id);
    return view('diary.edit', compact('diary'));
  }

  /**
   * 更新機能
   * @param \Illuminate\Http\Request
   * @param int $id 日記ID
   */
  public function update(Request $request, int $id): RedirectResponse
  {
    app()->make('update_diary')->updateDiary($request, $id);
    return to_route('index');
  }

  /**
   * 削除機能
   * @param string $id 日記ID
   */
  public function destroy(int $id): RedirectResponse
  {
    return to_route('index');
  }
}

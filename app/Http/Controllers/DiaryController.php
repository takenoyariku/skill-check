<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
{
  /**
   * 一覧ページ 表示
   * @return \Illuminate\View\View
   */
  public function index()
  {
    return view('index');
  }

  /**
   * 新規作成ページ 表示
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('diary.create');
  }

  /**
   * 新規作成機能
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    return to_route('index');
  }

  /**
   * 更新ページ 表示
   * @param string $id 日記ID
   * @return \Illuminate\View\View
   */
  public function edit(string $id)
  {
    return view('diary.edit');
  }

  /**
   * 更新機能
   * @param \Illuminate\Http\Request
   * @param string $id 日記ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, string $id)
  {
    return to_route('index');
  }

  /**
   * 削除機能
   * @param string $id 日記ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(string $id)
  {
    return to_route('index');
  }
}

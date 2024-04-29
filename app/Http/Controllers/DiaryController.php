<?php

namespace App\Http\Controllers;

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
    return view('index');
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
    return to_route('index');
  }

  /**
   * 更新ページ 表示
   * @param string $id 日記ID
   */
  public function edit(string $id): View
  {
    return view('diary.edit');
  }

  /**
   * 更新機能
   * @param \Illuminate\Http\Request
   * @param string $id 日記ID
   */
  public function update(Request $request, string $id): RedirectResponse
  {
    return to_route('index');
  }

  /**
   * 削除機能
   * @param string $id 日記ID
   */
  public function destroy(string $id): RedirectResponse
  {
    return to_route('index');
  }
}

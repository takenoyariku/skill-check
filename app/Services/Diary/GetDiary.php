<?php

namespace App\Services\Diary;

use App\Models\Diary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetDiary
{
  /**
   * 日記データ取得
   */
  public function getDiary(): LengthAwarePaginator
  {
    $diaries = Diary::query();

    return $diaries->paginate(5);
  }
}

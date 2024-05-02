<?php

namespace App\Services\Diary;

use App\Models\Diary;
use App\Utils\ImageDestroy;
use Illuminate\Support\Facades\DB;

class DestroyDiary
{  /**
  * @var App\Utils\ImageDestroy 画像削除クラスインスタンス
  */
  private $image_destroy;


  public function __construct(ImageDestroy $image_destroy)
  {
    $this->image_destroy = $image_destroy;
  }

  /**
   * 日記更新処理
   * @param int $id 日記ID
   */
  public function destroyDiary($id):void
  {
    $diary = Diary::find($id);

    DB::transaction(function() use($diary) {
      $diary->delete();
    });

    $this->image_destroy->destroyImage($id, $diary->image_path);
  }
}

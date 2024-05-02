<?php

namespace App\Services\Diary;

use App\Models\Diary;
use App\Utils\ImageUpload;
use App\Utils\ImageDestroy;
use Illuminate\Support\Facades\DB;

class UpdateDiary
{
  /**
   *@var int ユニックスタイム（画像保存フォルダ名に使用）
   */
  private $unix;

  /**
   * @var App\Utils\ImageUpload 画像アップロードクラスインスタンス
   */
  private $image_upload;

  /**
   * @var App\Utils\ImageDestroy 画像削除クラスインスタンス
   */
  private $image_destroy;


  public function __construct(ImageUpload $image_upload, ImageDestroy $image_destroy)
  {
    $this->unix = time();
    $this->image_upload = $image_upload;
    $this->image_destroy = $image_destroy;
  }

  /**
   * DB保存用画像名生成
   * @param \Illuminate\Http\Request
   */
  private function imageName($request): string
  {
    $image_name = $this->unix.'/'.$request->file('image')->getClientOriginalName();
    return $image_name;
  }

  /**
   * 日記新規作成処理
   * @param \Illuminate\Http\Request
   * @param int $id 日記ID
   */
  public function updateDiary($request, $id): void
  {
    DB::transaction(function() use($request, $id) {
      $diary = Diary::find($id);

      $this->image_destroy->destroyImage($request, $diary->image_path);

      $diary->update([
        'image_path' => $this->imageName($request),
        'comment' => $request->comment,
      ]);

      $this->image_upload->uploadImage($request, $this->unix);
    });
  }
}

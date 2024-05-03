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


  /**
   * @param App\Utils\ImageUpload $image_upload
   * @param App\Utils\ImageDestroy $image_destroy
   */
  public function __construct(ImageUpload $image_upload, ImageDestroy $image_destroy)
  {
    $this->unix = time();
    $this->image_upload = $image_upload;
    $this->image_destroy = $image_destroy;
  }

  /**
   * 対象日記データ取得
   * @param int $id 日記ID
   */
  private function getDiary($id): Diary
  {
    return Diary::find($id);
  }

  /**
   * DB保存用画像名生成
   * @param \App\Http\Requests\DiaryRequest
   * @param int $id 日記ID
   */
  private function imageName($request, $id): ?string
  {
    if($request->hasFile('image')){
      $image_name = $this->unix.'/'.$request->file('image')->getClientOriginalName();
    }else{
      $image_name = $this->getDiary($id)->image_path;
    }
    return $image_name;
  }

  /**
   * 日記更新処理
   * @param \App\Http\Requests\DiaryRequest
   * @param int $id 日記ID
   */
  public function updateDiary($request, $id): void
  {
    $diary = $this->getDiary($id);

    //更新前画像データ取得
    $image_path = $diary->image_path;

    DB::transaction(function() use($diary, $request, $id){
      $diary->update([
        'id' => $id,
        'image_path' => $this->imageName($request, $id),
        'comment' => $request->comment,
      ]);
    });

    try{
      if($request->hasFile('image')){
        $this->image_destroy->destroyImage($request, $image_path);
        $this->image_upload->uploadImage($request, $this->unix);
      }
    }catch(\Exception $e){
      report($e);
      session()->flash('error_message', '画像をアップロードできませんでした');
    }
  }
}

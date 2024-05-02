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
   * DB保存用画像名生成
   * @param \Illuminate\Http\Request
   */
  private function imageName($request): string
  {
    if($request->hasFile('image')){
      $image_name = $this->unix.'/'.$request->file('image')->getClientOriginalName();
    }else{
      $image_name = '';
    }
    return $image_name;
  }

  /**
   * 更新データ配列
   * @param \Illuminate\Http\Request
   * @param int $id 日記ID
   */
  private function updateData($request, $id): array
  {
    return [
      'id' => $id,
      'image_path' => $this->imageName($request),
      'comment' => $request->comment,
    ];
  }

  /**
   * 日記更新処理
   * @param \Illuminate\Http\Request
   * @param int $id 日記ID
   */
  public function updateDiary($request, $id): void
  {
    //日記データ取得
    $diary = Diary::find($id);

    //更新前画像データ取得
    $image_path = $diary->image_path;

    DB::transaction(function() use($diary, $request, $id){
      $diary->update($this->updateData($request, $id));
    });

    try{
      $this->image_destroy->destroyImage($request, $image_path);

      if($request->hasFile('image')){
        $this->image_upload->uploadImage($request, $this->unix);
      }
    }catch(\Exception $e){
      session()->flash('error_message', '画像がアップロードできませんでした');
    }
  }
}

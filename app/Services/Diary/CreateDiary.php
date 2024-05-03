<?php

namespace App\Services\Diary;

use App\Models\Diary;
use App\Utils\ImageUpload;
use Illuminate\Support\Facades\DB;

class CreateDiary
{
  /**
   *@var int ユニックスタイム（画像保存フォルダ名に使用）
   */
  private $unix;

  /**
   * @var App\Utils\ImageUpload 画像アップロードクラスインスタンス
   */
  private $image_upload;


  public function __construct(ImageUpload $image_upload)
  {
    $this->unix = time();
    $this->image_upload = $image_upload;
  }

  /**
   * DB保存用画像名生成
   * @param \App\Http\Requests\DiaryRequest
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
   * 日記新規作成処理
   * @param \App\Http\Requests\DiaryRequest
   */
  public function createDiary($request): void
  {
    DB::transaction(function() use($request) {
      Diary::create([
        'image_path' => $this->imageName($request),
        'comment' => $request->comment,
      ]);
    });

    try{
      $this->image_upload->uploadImage($request, $this->unix);
    }catch(\Exception $e){
      session()->flash('error_message', '画像をアップロードできませんでした');
    }
  }
}

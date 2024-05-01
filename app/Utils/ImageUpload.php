<?php

namespace App\Utils;

class ImageUpload
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
      //
  }

  /**
   * 画像をローカルストレージに保存
   * @param \Illuminate\Http\Request
   * @param int $folder ユニックスタイムで命名された保存用フォルダ名
   */
  public function uploadImage($request, $folder): void
  {
    if ($request->hasFile('image')) {
      $request->file('image')->storeAs('public/uploads/'.$folder, $request->file('image')->getClientOriginalName());
    }
  }
}

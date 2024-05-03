<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class ImageDestroy
{
  /**
   * 画像をローカルストレージから削除
   * @param string $image_name 対象画像パス
   */
  public function destroyImage($image_name): void
  {
    Storage::disk('public')->delete('uploads/'.$image_name);
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUploadModel extends Model
{
  public $table='imgUpload';
  public $primaryKey='id';
  public $incrementing=true;
  public $keyType='int';
  public $timestamps=false;
}

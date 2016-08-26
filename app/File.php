<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "files";
    protected $fillable = ["mime",'size','uploader','original_name','url','extension'];

}

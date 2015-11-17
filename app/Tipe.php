<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    //
    protected $table = 'tipe';
    protected $fillable = ['deskripsi'];
    protected $primaryKey = 'tipe_id';
}

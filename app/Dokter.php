<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    //
    protected  $table = 'dokter';
    protected $primaryKey = 'dokter_id';
    protected $fillable = ['nama','alamat','no_telpon','faskes_id'];

    public function faskes()
    {
        $this->belongsToMany('App\Faskes');
    }


    public function scopeKodeFaskes($query, $id)
    {
        return $query->where('faskes_id', $id);
    }

    public function praktek()
    {
        return $this->hasMany('App\ODokter');
    }


}

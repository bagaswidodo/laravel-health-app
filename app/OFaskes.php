<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OFaskes extends Model
{
    //
    protected $table = 'faskes_open';
    protected $fillable = ['faskes_id','hari','jam_buka','jam_tutup','jam_mulai_istirahat','jam_selesai_istirahat'];
    protected $primaryKey = 'faskes_id';

    //
//    public function articles(){
//        return $this->belongsToMany('App\Article');//,'tags_pivot');
//    }

    public function faskes(){
        return $this->belongsTo('App\Faskes');
    }

    public function scopeHari($query, $hari)
    {
        return $query->where('hari', $hari);
    }

    public function scopeKodeFaskes($query, $id)
    {
        return $query->where('faskes_id', $id);
    }

    public function scopeJadwal($query,$id,$hari)
    {
        return $query->where('faskes_id',$id)->where('hari',$hari);
    }
}

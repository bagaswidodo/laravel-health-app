<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    //

    protected $fillable = ['nama_faskes','tipe_id','user_id','alamat','latitude','longitude','web','phone','bpjs'];
    protected $primaryKey = 'faskes_id';

    //define relationship : faskes has many open times
    public function works()
    {
        return $this->hasMany('App\OFaskes');
    }

    //faskes has many dokters
    public function dokter()
    {
        return $this->hasMany('App\Dokter');
    }

    public function setBpjsAttribute($value)
    {
        $value = ($value=="on") ? 1 : 0;
        $this->attributes['bpjs'] = $value;
    }
}

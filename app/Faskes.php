<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    //

    protected $fillable = ['nama_faskes','tipe_id','user_id','alamat','latitude','longitude','bpjs'];
    protected $primaryKey = 'faskes_id';

    //define relationship : is user has many articles?
    public function works()
    {
        return $this->hasMany('App\OFaskes');
    }

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

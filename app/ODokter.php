<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ODokter extends Model
{
    //
    protected $table = 'dokter_faskes';
    protected $fillable = ['dokter_id','faskes_id','hari','jam_mulai','jam_selesai'];
    protected $primaryKey = 'dokter_id';

    public function dokter()
    {
        $this->belongsToMany('App\Dokter');
    }

    public function scopePraktek($query,$faskes,$dokter,$hari)
    {
        return $query->where('faskes_id',$faskes)->where('dokter_id', $dokter)->where('hari',$hari);
    }


}

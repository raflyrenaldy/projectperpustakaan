<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $fillable = [
    	'id_anggota','tgl_pinjam','tgl_kembali','status',
    ];

    protected $dates = ['tgl_pinjam','tgl_kembali'];


    public function get_member()
    {
        return $this->belongsTo('App\Model\anggota', 'id_anggota', 'id');
    }

    public function getCreatedAtAttribute()
{
    return \Carbon\Carbon::parse($this->attributes['tgl_pinjam'])
       ->format('d, M Y H:i');
}
}

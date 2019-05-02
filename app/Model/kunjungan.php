<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class kunjungan extends Model
{
    protected $fillable = [
    	'id_anggota',
    ];

    public function get_book()
    {
        return $this->belongsTo('App\Model\buku', 'id_buku', 'id');
    }

}

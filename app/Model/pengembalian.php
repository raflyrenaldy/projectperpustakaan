<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    protected $fillable = [
    	'id_peminjaman','tgl_diterima','telat','denda','lunas','status',
    ];

    protected $dates = ['tgl_diterima'];

    public function get_borrow()
    {
        return $this->belongsTo('App\Model\peminjaman', 'id_peminjaman', 'id');
    }
}

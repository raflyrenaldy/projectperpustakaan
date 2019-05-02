<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class loaned_book extends Model
{
    protected $fillable = [
    	'id_buku','id_peminjaman','status'
    ];

    public function get_book()
    {
        return $this->belongsTo('App\Model\buku', 'id_buku', 'id');
    }

    public function get_borrow()
    {
        return $this->belongsTo('App\Model\peminjaman', 'id_peminjaman', 'id');
    }
}

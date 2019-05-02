<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $fillable = [
    	'name','penerbit','pengarang','tahun_terbit','stock','rak',
    ];

}

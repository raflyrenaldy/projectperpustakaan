<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $fillable = [
    	'nis','name','phone','address','email','jum_buku',
    ];

}

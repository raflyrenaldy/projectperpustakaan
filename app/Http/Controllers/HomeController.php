<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\peminjaman;
use App\Model\pengembalian;
use App\Model\anggota;
use App\Model\buku;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $return = pengembalian::all()->count();
        $borrow = peminjaman::all()->count();
        $member = anggota::all()->count();
        $book = buku::all()->count();

        return view('home',compact('return','borrow','member','book'));
    }
}

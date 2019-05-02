<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\loaned_book;
use App\Model\pengembalian;
use App\Model\peminjaman;
use App\Model\anggota;
use App\Model\buku;
use Validator;
use Auth;
use Carbon\Carbon;
class returnController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = pengembalian::with('get_borrow')->orderBy('status','asc')->get();

        return view('return',compact('return'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = pengembalian::with('get_borrow')->findOrFail($id);
        $borrow = peminjaman::with('get_member')->findOrFail($return->get_borrow->id);
        $loaned_book = loaned_book::with('get_book')->where('id_peminjaman',$borrow->id)->get();
        $isPast = $borrow->tgl_kembali->isPast();
        if($isPast == false){
            $day = 0;
            $denda = 0;
        }else{
            $created = new Carbon($borrow->tgl_kembali->format('Y-m-d'));
            $now = date('Y-m-d');
            $day = $created->diffInDays($now);
            $denda = $day * 500;
            $book = 0;
            foreach($loaned_book as $key){
                if($key->status == 0){
                    $book +=  1;
                }
            }
            $denda = $denda * $book;
        }

        // dd($denda);
        return view('detailreturn',compact('borrow','loaned_book','denda','isPast','return'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {
        $return = pengembalian::with('get_borrow')->findOrFail($id);

        if($request->check == 1){
            $borrow = peminjaman::findOrFail($return->get_borrow->id);
            $member = anggota::findOrFail($borrow->id_anggota);
            $loaned_book = loaned_book::where('id_peminjaman','=',$borrow->id)->get();
            $jum_buku = 0;
            foreach($loaned_book as $key){
                $key->status = 0;
                $key->save();
                $jum_buku = $jum_buku + 1;
                $book = buku::findOrFail($key->id_buku);
                $book->stock = $book->stock - 1;
                $book->save();

            }
            $member->jum_buku = $member->jum_buku - $jum_buku;
            $member->save();
            $borrow->delete();
        }else
        {
            $borrow = peminjaman::findOrFail($return->get_borrow->id);

            $loaned_book = loaned_book::where('id_peminjaman','=',$borrow->id)->get();

            foreach($loaned_book as $key){
                $key->status = 0;
                $key->save();

                $book = buku::findOrFail($key->id_buku);
                $book->stock = $book->stock - 1;
                $book->save();

            }

            $borrow->status = 0;
            $borrow->save();

            $return->delete();
        }
        return back()->with('success_message','Data berhasil Dihapus!');
    }
}

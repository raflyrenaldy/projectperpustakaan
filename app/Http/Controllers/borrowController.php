<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pengembalian;
use App\Model\loaned_book;
use App\Model\peminjaman;
use App\Model\anggota;
use App\Model\buku;
use Validator;
use Auth;
use Carbon\Carbon;
class borrowController extends Controller
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
        $borrow = peminjaman::with('get_member')
        ->where('status','=',0)
        ->latest()
        ->get();
        // dd($borrow->tgl_kembali->isFuture());
        return view('borrow',compact('borrow'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = buku::where('stock','>',0)->get();
        $member = anggota::all();
        return view('createborrow',compact('book','member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->id_anggota);
        $rules = array(
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'tgl_kembali' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return redirect('/admin/borrow/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // $id_buku = explode(",",$request->get('id_buku'));

            $checkAvail = peminjaman::where([
                                        ['id_anggota','=',$request->get('id_anggota')],
                                        ['status','=',0],
                                    ])->count();
            if($checkAvail > 0){

                return back()->with('error_message','Gagal! Masih memiliki buku yang dipinjam');

            }else{
                $member = anggota::findOrFail($request->get('id_anggota'));
                $jum_buku = $member->jum_buku;
                $borrow = new peminjaman([
                    'id_anggota' => $request->get('id_anggota'),
                    'tgl_pinjam' => now(),
                    'tgl_kembali' => $request->get('tgl_kembali'),
                    'status' => 0,
                ]);
                    if($borrow->save()){
                        foreach($request->get('id_buku') as $key){
                            $loaned_book = new loaned_book([
                                'id_buku' => $key,
                                'id_peminjaman' => $borrow->id,
                                'status' => 0,
                            ]);
                            $loaned_book->save();
                            $jum_buku += 1;
                            $book = buku::findOrFail($key);
                            $book->stock = $book->stock - 1;
                            $book->save();
                        }
                        $member->jum_buku = $jum_buku;
                        $member->save();
                    }


                return redirect()->action('borrowController@index')->with('success_message','Data berhasil ditambahkan!');

            }


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrow = peminjaman::with('get_member')->findOrFail($id);
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
        return view('detailborrow',compact('borrow','loaned_book','denda','isPast'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrow = peminjaman::findOrFail($id);
        $loaned_book = loaned_book::where('id_peminjaman',$borrow->id)->get();

        foreach($loaned_book as $key)
        {
            $book_id[] = $key->id_buku;

        }
        $book = buku::where('stock','>',0)->get()->except($book_id);
        $member = anggota::all()->except($borrow->id_anggota);
        // dd($borrow->tgl_pinjam->format('Y-m-d'));
        return view('editborrow',compact('borrow','loaned_book','book','member'));
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
        $borrow  = peminjaman::findOrFail($id);
        $bookBefore = $borrow->id_buku;
        $memberBefore = $borrow->id_anggota;
        $rules = array(
            'id_anggota' => 'required|numeric',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            if($borrow->id_anggota != $request->id_anggota){
                $checkAvailable = peminjaman::where ([
                                ['id_anggota', '=',$request->id_anggota],
                                ['status','=',0],
                            ])->get();

                if($checkAvailable->isEmpty()){
                    // $borrow->id_buku = $request->get('id_buku');
                    $borrow->id_anggota = $request->get('id_anggota');
                    $borrow->tgl_pinjam = $request->get('tgl_pinjam');
                    $borrow->tgl_kembali = $request->get('tgl_kembali');

                    if($memberBefore != $request->get('id_anggota')){
                        $member = anggota::findOrFail($memberBefore);
                        $member->jum_buku -= 1;
                        $member->save();

                        $member = anggota::findOrFail($request->get('id_anggota'));
                        $member->jum_buku += 1;
                        $member->save();
                    }

                }else{
                    return back()->with('error_message','Data gagal Diubah!');
                }
            }else{
                $borrow->tgl_pinjam = $request->get('tgl_pinjam');
                $borrow->tgl_kembali = $request->get('tgl_kembali');
            }

            if($borrow->save()){
                return back()->with('success_message','Data berhasil Diubah!');
            }else{
                return back()->with('error_message','Data gagal Diubah!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {
        $borrow = peminjaman::findOrFail($request->get('id'));
        $member = anggota::findOrFail($borrow->id_anggota);

        $loaned_book = loaned_book::where('id_peminjaman',$borrow->id);
        foreach($loaned_book as $key){
            if($key->status == 0){
                $book = buku::findOrFail($key->id_buku);
                $book->stock = $book->stock + 1;
                $book->save();
            }
        }
        $member->jum_buku -= 1;
        $member->save();
        if($borrow->delete()){
            return back()->with('success_message','Data berhasil Dihapus!');
        }else{
            return back()->with('error_message','Data gagal Dihapus!');
        }
    }

    public function return($id)
    {
        $borrow = peminjaman::findOrFail($id);
        $isFuture = $borrow->tgl_kembali->isFuture();
        if($isFuture == false){
            $day = 0;
            $denda = 0;
        }else{
            $created = new Carbon($borrow->tgl_kembali->format('Y-m-d'));
            $now = date('Y-m-d');
            $day = $created->diffInDays($now);
            $denda = $day * 500;
        }

        return view('returnbook',compact('borrow','day','denda','isFuture'));

    }

    public function cancelreturn($id)
    {
        $borrow = peminjaman::findOrFail($id);

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

        $return = pengembalian::where('id_peminjaman','=',$borrow->id)->first();
        $return->delete();

        return redirect()->route('detailborrow', $id)->with('success_message', 'Buku Berhasil Batal Dikembalikan!');
    }

    public function returned($id)
    {
        $borrow = peminjaman::findOrFail($id);

        $loaned_book = loaned_book::where('id_peminjaman','=',$borrow->id)->get();



        $borrow->status = 1;
        $borrow->save();


        $created = new Carbon($borrow->tgl_kembali->format('Y-m-d'));
            $now = date('Y-m-d');
            $day = $created->diffInDays($now);
            $denda = $day * 500;
            $book = 0;
        if($day < 1){
            $day = 0;
            $denda = 0;
            $return = new pengembalian([
                'id_peminjaman' => $borrow->id,
                'tgl_diterima' => now(),
                'telat' => 0,
                'denda' => 0,
                'status' => 1,
            ]);
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
            $return = new pengembalian([
                'id_peminjaman' => $borrow->id,
                'tgl_diterima' => now(),
                'telat' => 1,
                'denda' => $denda,
                'status' => 1,
            ]);
        }
        foreach($loaned_book as $key){
            $key->status = 1;
            $key->save();

            $book = buku::findOrFail($key->id_buku);
            $book->stock = $book->stock + 1;
            $book->save();

        }

        $return->save();

        return redirect()->route('detailreturn', $return->id)->with('success_message', 'Buku Berhasil Dikembalikan!');

    }


    public function returnonebook($id)
    {
        $loaned_book = loaned_book::findOrFail($id);
        $loaned_book->status = 1;
        $loaned_book->save();

        $book = buku::findOrFail($loaned_book->id_buku);
        $book->stock = $book->stock + 1;
        $book->save();

        $borrow = loaned_book::where('id_peminjaman',$loaned_book->id_peminjaman)->get();
        foreach($borrow as $datas){
            if($datas->status == 0){
                $finished = false;
            }else{
                $finished = true;
            }
        }
        if($finished == true){
            $borrow = peminjaman::findOrFail($loaned_book->id_peminjaman);
            $borrow->status = 1;
            $borrow->save();

            $return = new pengembalian([
                'id_peminjaman' => $borrow->id,
                'tgl_diterima' => now(),
                'telat' => 0,
                'denda' => 0,
                'status' => 1,
            ]);

            $return->save();
        return redirect()->route('detailreturn', $return->id)->with('success_message', 'Buku Berhasil Dikembalikan!');

        }else{

        return back()->with('success_message','Buku ' .$loaned_book->get_book->name .' Sudah Dikembalikan');

        }
    }

    public function updatebook(request $request,$id)
    {
        // dd($request->all());
        $loaned_book = loaned_book::findOrFail($id);
        $oldBook = buku::findOrFail($loaned_book->id_buku);
        $oldBook->stock = $oldBook->stock + 1;
        $oldBook->save();

        $loaned_book->id_buku = $request->get('id_buku');
        $loaned_book->save();

        $newBook = buku::findOrFail($request->get('id_buku'));
        $newBook->stock = $newBook->stock + 1;
        $newBook->save();


        return back()->with('success_message','Buku Berhasil Diperbarui');
    }

    public function addbook(request $request, $id)
    {
        $borrow = peminjaman::findOrFail($id);
        $member = anggota::findOrFail($borrow->id_anggota);
        $jum_buku = $member->jum_buku;
            if($borrow->save()){
                foreach($request->get('id_buku') as $key){
                    $loaned_book = new loaned_book([
                        'id_buku' => $key,
                        'id_peminjaman' => $borrow->id,
                        'status' => 0,
                    ]);
                    $loaned_book->save();
                    $jum_buku += 1;
                    $book = buku::findOrFail($key);
                    $book->stock = $book->stock - 1;
                    $book->save();
                }
                $member->jum_buku = $jum_buku;
                $member->save();
            }
        return back()->with('success_message','Buku Berhasil Ditambahkan');
    }
}

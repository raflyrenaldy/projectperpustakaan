<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\buku;
use Validator;
use Auth;
class bookController extends Controller
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
        $book = buku::all();

        return view('book',compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createbook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'stock' => 'required',
            'rak' => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return redirect('/admin/book/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $book = new buku([
                'name' => $request->get('name'),
                'penerbit' => $request->get('penerbit'),
                'pengarang' => $request->get('pengarang'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'stock' => $request->get('stock'),
                'rak' => $request->get('rak'),
            ]);
            if($book->save()){
                return redirect()->action('bookController@index')->with('success_message','Data berhasil ditambahkan!');
            }else{
                return back()->with('error_message','Data gagal ditambahkan!');
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
        $book = buku::findOrfail($id);

        return view('detailbook',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = buku::findOrFail($id);

        return view('editbook',compact('book'));
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
        $book  = buku::findOrFail($id);
        $rules = array(
            'name' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'stock' => 'required',
            'rak' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }else{
        $book->name = $request->get('name');
        $book->penerbit = $request->get('penerbit');
        $book->pengarang = $request->get('pengarang');
        $book->tahun_terbit = $request->get('tahun_terbit');
        $book->stock = $request->get('stock');
        $book->rak = $request->get('rak');
        if($book->save()){
            return redirect()->action('bookController@index')->with('success_message','Data berhasil Diubah!');
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
    public function destroy($id)
    {
        $book = buku::findOrFail($id);
        if($book->delete()){
            return back()->with('success_message','Data berhasil Dihapus!');
        }else{
            return back()->with('error_message','Data gagal Dihapus!');
            }
    }
}

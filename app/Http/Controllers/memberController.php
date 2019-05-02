<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\anggota;
use Validator;
use Auth;

class memberController extends Controller
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
        $member = anggota::select('nis','name','jum_buku','phone')
                        ->orderBy('jum_buku','asc')
                        ->get();

        return view('member',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createmember');
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
            'nis' => 'required|unique:anggotas',
            'nama' => 'required',
            'phone' => 'required|numeric|unique:anggotas',
            'alamat' => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return redirect('/admin/member/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $member = new anggota([
                'nis' => $request->get('nis'),
                'name' => $request->get('nama'),
                'phone' => $request->get('phone'),
                'address' => $request->get('alamat'),
            ]);
            if($member->save()){
                return redirect()->action('memberController@index')->with('success_message','Data berhasil ditambahkan!');
            }else{
                return back()->with('error_message','Data gagal ditambahkan!');
            }
        }
    }

    public function check(request $request)
    {
        if($request->get('nis'))
        {
            $nis = $request->get('nis');
            $data = anggota::where('nis','=',$nis)->count();
            if($data > 0){
                echo 'not unique';
            }else{
                echo 'unique';
            }
        }else{
            $email = $request->get('email');
            $data = anggota::where('email','=',$email)->count();
            if($data > 0){
                echo 'not unique';
            }else{
                echo 'unique';
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $member = anggota::where('nis','=',$nis)->first();

        return view('detailmember',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nis)
    {
        $member = anggota::where('nis','=',$nis)->first();
        // dd($member);
        return view('editmember',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nis)
    {
        $member  = anggota::where('nis','=',$nis)->first();
        $rules = array(
            'nis' => 'required|unique:anggotas,nis,'.$member->id,
            'nama' => 'required',
            'phone' => 'required|numeric|unique:anggotas,phone,' .$member->id,
            'alamat' => 'required',
            'email' => 'unique:anggotas,email,' .$member->id,
        );
        $validator = Validator::make ( $request->all(), $rules);
         if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }else{
        $member->nis = $request->get('nis');
        $member->name = $request->get('nama');
        $member->phone = $request->get('phone');
        $member->address = $request->get('alamat');
        $member->email = $request->get('email');
        if($member->save()){
            return redirect()->action('memberController@index')->with('success_message','Data berhasil Diubah!');
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
    public function destroy($nis)
    {
        $member = anggota::where('nis',$nis)->first();
        if($member->delete()){
            return back()->with('success_message','Data berhasil Dihapus!');
        }else{
            return back()->with('error_message','Data gagal Dihapus!');
            }
    }
}

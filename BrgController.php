<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brg;

class BrgController extends Controller
{
    function idx(Request $r){
        $q = Brg::query();
        if($r->cari) $q->where('nm', 'like', '%'.$r->cari.'%');
        if($r->kat) $q->where('kat', $r->kat);
        $brg = $q->paginate(10);
        $kats = Brg::select('kat')->distinct()->pluck('kat');
        return view('brg', compact('brg','kats'));
    }

    function smp(Request $r){
        $b = new Brg;
        $b->nm = $r->nm;
        $b->hrg = $r->hrg;
        $b->kat = $r->kat;
        $b->desk = $r->desk;
        $b->save();
        return back();
    }

    function hapus($id){
        Brg::destroy($id);
        return back();
    }

    function edit($id){
        $d = Brg::find($id);
        $brg = Brg::paginate(10);
        $kats = Brg::select('kat')->distinct()->pluck('kat');
        return view('brg', compact('d', 'brg', 'kats'));
    }

    function update(Request $r, $id){
        $b = Brg::find($id);
        $b->nm = $r->nm;
        $b->hrg = $r->hrg;
        $b->kat = $r->kat;
        $b->desk = $r->desk;
        $b->save();
        return redirect('/');
    }
}
?>
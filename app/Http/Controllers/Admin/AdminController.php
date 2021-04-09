<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Statistik;
use App\User;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Statistik::join('users', 'statistik.user_id', '=', 'users.id')
        ->orderBy('poin', 'DESC')
        ->orderBy('GM', 'DESC')
        ->get();
        return view('home', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah_player');
    }

    public function dashboard()
    {
        $user = Statistik::join('users', 'statistik.user_id', '=', 'users.id')
        ->orderBy('poin', 'DESC')
        ->orderBy('GM', 'DESC')
        ->get();
        $t_win = Statistik::select('win')->sum('win');
        $t_lose = Statistik::select('lose')->sum('lose');
        $t_draw = Statistik::select('draw')->sum('draw');
        $t_gm = Statistik::select('GM')->sum('GM');
        $t_gl = Statistik::select('GL')->sum('GL');

        return view('dashboard', compact('user', 't_win', 't_lose', 't_draw', 't_gm', 't_gl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = (string)Uuid::generate(4);
        User::create([
            'id' => $id,
            'name' => $request->name,
            'level' => $request->level,
            'password' => Hash::make($request->password)
        ]);

        Statistik::create([
            'user_id' => $id
        ]);

        return redirect()->route('admin')->with(['player_add' => 'Player berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bulan = date('M');
        $stat = Statistik::join('users', 'statistik.user_id', '=', 'users.id')
        ->where('user_id', '=', $id)
        ->where('bulan', '=', $bulan)
        ->select('name','win','lose','draw','bulan')
        ->first();

        if ($stat == null) {
            return redirect()->back()->with(['fail' => 'Player belum memiliki pertandingan']);
        }

        $goal = Statistik::join('users', 'statistik.user_id', '=', 'users.id')
        ->where('statistik.user_id', '=', $id)
        ->where('bulan', '=', $bulan)
        ->select('GM','GL')
        ->first();
        return view('welcome', compact('stat','goal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $player = Statistik::join('users', 'statistik.user_id', '=', 'users.id')
        ->where('statistik.user_id', '=', $id)
        ->first();
        return view('ubah_skor', compact('player'));
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
        $tes = Statistik::where('user_id', '=', $id)->first();
        if ($request->win != '0') {
            $poin = $request->win * 3;
        } elseif ($request->lose != '0') {
            $poin = $request->lose * 0;
        } elseif ($request->draw != '0') {
            $poin = $request->draw * 1;
        }

        $match = $tes->match + $request->match;
        $win = $tes->win + $request->win;
        $lose = $tes->lose + $request->lose;
        $draw = $tes->draw + $request->draw;
        $gm = $tes->GM + $request->gm;
        $gl = $tes->GL + $request->gl;
        $bulan = date('M');
        $point = $tes->poin + $poin;

        Statistik::where('user_id', '=', $id)
        ->update([
            'match' => $match,
            'win' => $win,
            'lose' => $lose,
            'draw' => $draw,
            'bulan' => $bulan,
            'gm' => $gm,
            'gl' => $gl,
            'poin' => $point
            ]);

        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

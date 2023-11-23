<?php

namespace App\Http\Controllers;

use App\Services\MusicService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class Controller extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
    }
    public function index()
    {
        $apiservice = new MusicService();
        $allmusic = $apiservice->showallmusic();

        return view('playmusic', compact('allmusic'));
    }
    public function addMusic(Request $request)
    {
        $apiservice = new MusicService();
        $addmusic = $apiservice->addMusic($request->all());
        if ($addmusic->status === "success") {
            session()->flash('message', 'Music berhasil Ditambah');
            return redirect()->to('/');
        } else {
            session()->flash('error', 'Music Gagal Ditambah');
            return redirect()->to('/');
        }
    }
    public function delete(string $id)
    {

        $apiservice = new MusicService();
        $addmusic = $apiservice->delete($id);
        if ($addmusic->status === "success") {
            session()->flash('message', 'Music berhasil terdelete');
            return redirect()->to('/');
        } else {
            session()->flash('error', 'Music Gagal terdelete');
            return redirect()->to('/');
        }
    }
    public function edit(Request $request)
    {
        $apiservice = new MusicService();
        $addmusic = $apiservice->edit($request->all());
        if ($addmusic->status === "success") {
            session()->flash('message', 'Music berhasil Diedit');
            return redirect()->to('/');
        } else {
            session()->flash('error', 'Music Gagal Diedit');
            return redirect()->to('/');
        }
    }
}

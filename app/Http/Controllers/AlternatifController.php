<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AlternatifController extends Controller
{
    public function index(){
        return view('alternatif', [
            'title' => 'ALTERNATIF',
            'alternatif' => AlternatifModel::all()
        ]);
    }
    public function create(){
        return view('tambahAlternatif', [
            'title' => 'TAMBAH ALTERNATIF',
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'nama_sekolah' => 'required|max:255', 
            'alamat' => 'required',
            'contact' => 'required',
            'instagram' => 'required',
            'website_sekolah' => 'required',
            'npsn' => 'required', 
            'akreditasi'=> 'required', 
            'ruang_kelas'=> 'required', 
            'laboratorium'=> 'required', 
            'perpustakaan'=> 'required', 
            'uks'=> 'required', 
            'sanitasi'=> 'required', 
            'tempat_ibadah'=> 'required', 
            'guru'=> 'required', 
            'ekstrakulikuler'=> 'required', 
            'biaya_masuk'=> 'required', 
            'biaya_spp'=> 'required', 
            'longitude'=> 'required', 
            'latitude'=> 'required'
        ]);

        $validateData['user_id'] = auth()->user()->id;
        AlternatifModel::create($validateData);
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        AlternatifModel::where('id', $id)->delete();
        return redirect('/dashboard');
    }

    public function edit($id)
    {
        $alternative = AlternatifModel::findOrFail($id);
        return view('editAlternatif',[
            'title'=> 'Edit Alternatif'
        ], compact('alternative'));
    }

    public function update(Request $request, $id) {
        $validateOldData = $request->validate([
            'nama_sekolah' => 'required|max:255', 
            'alamat' => 'required',
            'contact' => 'required',
            'instagram' => 'required',
            'website_sekolah' => 'required',
            'npsn' => 'required', 
            'akreditasi'=> 'required', 
            'ruang_kelas'=> 'required', 
            'laboratorium'=> 'required', 
            'perpustakaan'=> 'required', 
            'uks'=> 'required', 
            'sanitasi'=> 'required', 
            'tempat_ibadah'=> 'required', 
            'guru'=> 'required', 
            'ekstrakulikuler'=> 'required', 
            'biaya_masuk'=> 'required', 
            'biaya_spp'=> 'required', 
            'longitude'=> 'required', 
            'latitude'=> 'required'
        ]);
        $validateOldData['user_id'] = auth()->user()->id;
        $alternative = AlternatifModel::findOrFail($id);
        if ($alternative->update($validateOldData)) {
            return redirect('/alternatif');
        } else {
            return back()->with('error', 'Update Failed');
        }
    }

}

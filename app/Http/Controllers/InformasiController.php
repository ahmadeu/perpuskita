<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // Tampil publik
    public function show($slug)
    {
        $informasi = Informasi::where('slug', $slug)->firstOrFail();
        return view('informasi.show', compact('informasi'));
    }

    // List semua informasi (admin)
    public function index()
    {
        $informasis = Informasi::all();
        return view('informasi.index', compact('informasis'));
    }

    // Form tambah (admin)
    public function create()
    {
        return view('informasi.create');
    }

    // Simpan data baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:informasi,slug',
            'judul' => 'required',
            'konten' => 'nullable',
        ]);
        Informasi::create($request->only('slug','judul','konten'));
        return redirect()->route('informasi.index')->with('success','Informasi berhasil ditambahkan');
    }

    // Form edit (admin)
    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('informasi.edit', compact('informasi'));
    }

    // Update data (admin)
    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);
        $request->validate([
            'slug' => 'required|unique:informasi,slug,'.$informasi->id,
            'judul' => 'required',
            'konten' => 'nullable',
        ]);
        $informasi->update($request->only('slug','judul','konten'));
        return redirect()->route('informasi.index')->with('success','Informasi berhasil diupdate');
    }

    // Hapus data (admin)
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();
        return redirect()->route('informasi.index')->with('success','Informasi berhasil dihapus');
    }

    public function editAll()
    {
        $data = Informasi::whereIn('slug', ['profil', 'standar-pelayanan', 'waktu-pelayanan', 'pustakawan'])
            ->get()
            ->keyBy('slug');
        return view('informasi.edit_all', compact('data'));
    }

    public function updateAll(Request $request)
    {
        $slugs = ['profil', 'standar-pelayanan', 'waktu-pelayanan', 'pustakawan'];
        foreach ($slugs as $slug) {
            $data = [
                'judul' => $request->input("judul_$slug"),
                'konten' => $request->input("konten_$slug"),
            ];
            if ($request->hasFile("gambar_$slug")) {
                $file = $request->file("gambar_$slug");
                $filename = $slug . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/informasi', $filename);
                $data['gambar'] = $filename;
            }
            Informasi::updateOrCreate(
                ['slug' => $slug],
                $data
            );
        }
        return redirect()->route('informasi.editAll')->with('success', 'Informasi berhasil diperbarui');
    }
} 
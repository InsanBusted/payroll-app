<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::withCount('employees')->latest()->get();
        return view('jabatans.index', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100|unique:jabatans,nama',
            'deskripsi'=> 'nullable|string|max:255',
        ]);

        Jabatan::create($request->only('nama', 'deskripsi'));

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:100', Rule::unique('jabatans')->ignore($jabatan->id)],
            'deskripsi'=> 'nullable|string|max:255',
        ]);

        $jabatan->update($request->only('nama', 'deskripsi'));

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan "' . $jabatan->nama . '" berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->employees()->exists()) {
            return redirect()->route('jabatans.index')
                ->with('error', 'Jabatan "' . $jabatan->nama . '" tidak dapat dihapus karena masih digunakan oleh ' . $jabatan->employees()->count() . ' karyawan.');
        }

        $jabatan->delete();

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::withCount('employees')->latest()->get();
        return view('areas.index', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100|unique:areas,nama',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Area::create($request->only(['nama', 'deskripsi']));

        return redirect()->route('areas.index')
            ->with('success', 'Area "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:100', Rule::unique('areas')->ignore($area->id)],
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $area->update($request->only(['nama', 'deskripsi']));

        return redirect()->route('areas.index')
            ->with('success', 'Area "' . $area->nama . '" berhasil diperbarui.');
    }

    public function destroy(Area $area)
    {
        if ($area->employees()->exists()) {
            return redirect()->route('areas.index')
                ->with('error', 'Area "' . $area->nama . '" tidak dapat dihapus karena masih digunakan oleh ' . $area->employees()->count() . ' karyawan.');
        }

        $area->delete($area->id);

        return redirect()->route('areas.index')
            ->with('success', 'Area berhasil dihapus.');
    }
}

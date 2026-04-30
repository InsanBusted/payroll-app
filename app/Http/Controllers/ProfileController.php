<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Area;
use App\Models\Employee;
use App\Models\Jabatan;
use App\Models\PtkpStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile user + data karyawan terkait.
     */
    public function edit(Request $request): View
    {
        $user     = $request->user();
        $employee = $user->employee;

        $jabatans     = Jabatan::orderBy('nama', 'asc')->get();
        $areas        = Area::orderBy('nama', 'asc')->get();
        $ptkpStatuses = PtkpStatus::orderBy('status', 'asc')->get();

        return view('profile.edit', compact('user', 'employee', 'jabatans', 'areas', 'ptkpStatuses'));
    }

    /**
     * Update data akun (name, email, password).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Informasi akun berhasil diperbarui.');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.confirmed'                => 'Konfirmasi password tidak cocok.',
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.edit')->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Simpan / update data karyawan milik user yang sedang login.
     */
    public function updateEmployee(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Superadmin tidak perlu data karyawan
        if ($user->hasRole('superadmin')) {
            return Redirect::route('profile.edit')
                ->with('error', 'Superadmin tidak memiliki data karyawan.');
        }
        $request->validate([
            'nik'            => [
                'required',
                'string',
                'max:30',
                \Illuminate\Validation\Rule::unique('employees', 'nik')
                    ->ignore($user->employee?->id)
            ],
            'nama'           => 'required|string|max:150',
            'jabatan_id'     => 'nullable|exists:jabatans,id',
            'area_id'        => 'nullable|exists:areas,id',
            'ptkp_status_id' => 'nullable|exists:ptkp_statuses,id',
            'no_rek_bank'    => 'nullable|string|max:50',
            'nama_bank'      => 'nullable|string|max:50',
            'signature_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only(['nik', 'nama', 'jabatan_id', 'area_id', 'ptkp_status_id', 'no_rek_bank', 'nama_bank']);
        $data['user_id'] = $user->id;

        if ($request->hasFile('signature_path')) {
            // Hapus signature lama jika ada
            if ($user->employee?->signature_path) {
                Storage::disk('public')->delete($user->employee->signature_path);
            }
            $data['signature_path'] = $request->file('signature_path')->store('signatures', 'public');
        }

        if ($user->employee) {
            $user->employee->update($data);
            $msg = 'Data karyawan berhasil diperbarui.';
        } else {
            Employee::create($data);
            $msg = 'Data karyawan berhasil dibuat.';
        }

        return Redirect::route('profile.edit')->with('success', $msg);
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete($user->id);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

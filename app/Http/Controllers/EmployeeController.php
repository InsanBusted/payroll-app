<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Employee;
use App\Models\Jabatan;
use App\Models\PtkpStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'jabatan', 'area', 'ptkpStatus'])->latest()->paginate(10);
        $jabatans     = Jabatan::orderBy('nama', 'asc')->get();
        $areas        = Area::orderBy('nama', 'asc')->get();
        $ptkpStatuses = PtkpStatus::orderBy('status', 'asc')->get();
        // cuman user yang belum punya employee yang ditampilkan untuk dropdown
        $users = User::whereDoesntHave('employee')->orderBy('name', 'asc')->get();

        // Stats
        $employee = Employee::with('user')->get();

        $totalEmployees    = $employee->count();
        $linkedEmployees   = $employee->whereNotNull('user_id')->count();
        $unlinkedEmployees = $employee->whereNull('user_id')->count();

        return view('employees.index', compact('employees', 'jabatans', 'areas', 'users', 'ptkpStatuses', 'totalEmployees', 'linkedEmployees', 'unlinkedEmployees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'            => 'required|string|max:30|unique:employees,nik',
            'nama'           => 'required|string|max:150',
            'jabatan_id'     => 'nullable|exists:jabatans,id',
            'area_id'        => 'nullable|exists:areas,id',
            'ptkp_status_id' => 'nullable|exists:ptkp_statuses,id',
            'no_rek_bank'    => 'nullable|string|max:50',
            'nama_bank'      => 'nullable|string|max:50',
            'user_id'        => 'nullable|exists:users,id|unique:employees,user_id',
            'signature_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only(['nik', 'nama', 'jabatan_id', 'area_id', 'ptkp_status_id', 'no_rek_bank', 'nama_bank', 'user_id']);


        if ($request->hasFile('signature_path')) {
            $data['signature_path'] = $request->file('signature_path')
                ->store('signatures', 'public');
        }

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nik'            => ['required', 'string', 'max:30', Rule::unique('employees')->ignore($employee->id)],
            'nama'           => 'required|string|max:150',
            'jabatan_id'     => 'nullable|exists:jabatans,id',
            'area_id'        => 'nullable|exists:areas,id',
            'ptkp_status_id' => 'nullable|exists:ptkp_statuses,id',
            'no_rek_bank'    => 'nullable|string|max:50',
            'nama_bank'      => 'nullable|string|max:50',
            'user_id'        => ['nullable', 'exists:users,id', Rule::unique('employees')->ignore($employee->id)],
            'signature_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = $request->only(['nik', 'nama', 'jabatan_id', 'area_id', 'ptkp_status_id', 'no_rek_bank', 'nama_bank', 'user_id']);

        if ($request->hasFile('signature_path')) {
            // Delete old signature if exists
            if ($employee->signature_path) {
                Storage::disk('public')->delete($employee->signature_path);
            }
            $data['signature_path'] = $request->file('signature_path')
                ->store('signatures', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan "' . $employee->nama . '" berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        // Delete signature file if exists
        if ($employee->signature_path) {
            Storage::disk('public')->delete($employee->signature_path);
        }

        $nama = $employee->nama;
        $employee->delete($employee->id);

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan "' . $nama . '" berhasil dihapus.');
    }
}

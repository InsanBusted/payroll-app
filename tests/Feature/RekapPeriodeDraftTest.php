<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\RekapPeriode;
use App\Models\EmployeeKinerja;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RekapPeriodeDraftTest extends TestCase
{
    use RefreshDatabase;

    private User $finance;
    private User $direktur;
    private RekapPeriode $draftRekap;
    private RekapPeriode $submittedRekap;

    protected function setUp(): void
    {
        parent::setUp();

        $financeRole = Role::create(['name' => 'finance', 'display_name' => 'Finance']);
        $direkturRole = Role::create(['name' => 'direktur', 'display_name' => 'Direktur']);

        $this->finance = User::factory()->create(['role_id' => $financeRole->id]);
        $this->direktur = User::factory()->create(['role_id' => $direkturRole->id]);

        $this->draftRekap = RekapPeriode::create([
            'periode' => '2026-05',
            'is_draft' => true,
            'is_approved' => false,
            'is_rejected' => false,
        ]);

        $this->submittedRekap = RekapPeriode::create([
            'periode' => '2026-04',
            'is_draft' => false,
            'is_approved' => false,
            'is_rejected' => false,
        ]);
    }

    public function test_finance_can_see_drafts_and_submitted_rekaps_in_index(): void
    {
        $response = $this->actingAs($this->finance)->get('/rekap-periodes');

        $response->assertOk();
        $response->assertSee('2026-05');
        $response->assertSee('2026-04');
    }

    public function test_direktur_only_sees_submitted_rekaps_in_index(): void
    {
        $response = $this->actingAs($this->direktur)->get('/rekap-periodes');

        $response->assertOk();
        $response->assertDontSee('2026-05');
        $response->assertSee('2026-04');
    }

    public function test_direktur_cannot_view_draft_rekap_detail(): void
    {
        $response = $this->actingAs($this->direktur)->get("/rekap-periodes/{$this->draftRekap->id}");

        $response->assertStatus(403);
    }

    public function test_direktur_can_view_submitted_rekap_detail(): void
    {
        $response = $this->actingAs($this->direktur)->get("/rekap-periodes/{$this->submittedRekap->id}");

        $response->assertOk();
    }

    public function test_finance_can_submit_draft_rekap(): void
    {
        $response = $this->actingAs($this->finance)->patch("/rekap-periodes/{$this->draftRekap->id}/submit");

        $response->assertRedirect();
        $this->assertFalse($this->draftRekap->fresh()->is_draft);
    }

    public function test_direktur_cannot_submit_draft_rekap(): void
    {
        $response = $this->actingAs($this->direktur)->patch("/rekap-periodes/{$this->draftRekap->id}/submit");

        $response->assertStatus(403);
        $this->assertTrue($this->draftRekap->fresh()->is_draft);
    }

    public function test_direktur_only_sees_approved_periodes_performance_list_and_details(): void
    {
        $employee = \App\Models\Employee::create([
            'nama' => 'John Doe',
            'nik' => 'JD123',
            'no_rek_bank' => '123',
            'nama_bank' => 'BCA',
        ]);

        $approvedPerformance = EmployeeKinerja::create([
            'employee_id' => $employee->id,
            'periode' => '2026-04',
            'total_hadir' => 20,
            'tunjangan_groom' => 0,
            'srp' => 0,
            'grosir' => 0,
            'aksesoris' => 0,
        ]);

        $draftPerformance = EmployeeKinerja::create([
            'employee_id' => $employee->id,
            'periode' => '2026-05',
            'total_hadir' => 20,
            'tunjangan_groom' => 0,
            'srp' => 0,
            'grosir' => 0,
            'aksesoris' => 0,
        ]);

        // When submittedRekap (2026-04) is not approved yet, Direktur sees neither in list page
        $response = $this->actingAs($this->direktur)->get('/kinerjas');
        $response->assertOk();
        $response->assertDontSee('2026-04');
        $response->assertDontSee('2026-05');

        // Approve the 2026-04 rekap
        $this->submittedRekap->update(['is_approved' => true]);

        // Now Direktur sees 2026-04 but still doesn't see 2026-05 (which is draft & unapproved)
        $response = $this->actingAs($this->direktur)->get('/kinerjas');
        $response->assertOk();
        $response->assertSee('2026-04');
        $response->assertDontSee('2026-05');

        // Direktur tries to view unapproved detail directly, should be 403 Forbidden
        $response = $this->actingAs($this->direktur)->get("/kinerjas/{$draftPerformance->id}");
        $response->assertStatus(403);

        // Direktur views approved detail directly, should be 200 OK
        $response = $this->actingAs($this->direktur)->get("/kinerjas/{$approvedPerformance->id}");
        $response->assertOk();
    }
}

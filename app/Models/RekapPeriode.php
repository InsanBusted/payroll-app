<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekapPeriode extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode',
        'is_approved',
        'approved_by',
        'approved_at',
        'is_rejected',
        'rejected_by',
        'rejected_at',
        'catatan_tolak',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
            'is_rejected' => 'boolean',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Ambil label nama bulan Indonesia dari periode YYYY-MM.
     */
    public function getLabelAttribute(): string
    {
        [$y, $m] = explode('-', $this->periode);
        $bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
                  'Juli','Agustus','September','Oktober','November','Desember'];
        return ($bulan[(int)$m] ?? $m) . ' ' . $y;
    }
}

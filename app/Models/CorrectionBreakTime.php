<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CorrectionBreakTime extends Model
{
    use HasFactory;

    /**
     * 複数代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'corrected_break_start_at',
        'corrected_break_end_at'
    ];

    public function correction(): BelongsTo
    {
        return $this->belongsTo(Correction::class);
    }
}

<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use HasFactory;

    /**
     * 複数代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in_at',
        'clock_out_at',
    ];

    protected $casts = [
        'work_date' => 'date',
        'clock_in_at'  => 'datetime',
        'clock_out_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function correction(): HasOne
    {
        return $this->hasOne(AttendanceCorrection::class);
    }

    public function attendanceBreakTimes(): HasMany
    {
        return $this->hasMany(AttendanceBreakTime::class);
    }

    /**
     * 出勤済みかどうかを判定する
     *
     * clock_in_at が存在すれば出勤済み
     *
     * @return bool 出勤済みの場合 true
     */
    public function isClockedIn(): bool
    {
        return $this->clock_in_at !== null;
    }

    /**
     * 退勤済みかどうかを判定する
     *
     * clock_out_at が存在すれば退勤済み
     *
     * @return bool 退勤済みの場合 true
     */
    public function isClockedOut(): bool
    {
        return $this->clock_out_at !== null;
    }

    /**
     * 休憩中かどうかを判定する
     *
     * break_end が未登録の休憩レコードが存在する場合 true
     *
     * @return bool 休憩中の場合 true
     */
    public function isBreaking(): bool
    {
        return $this->AttendanceBreakTimes()->whereNull('break_end_at')->exists();
    }

    /**
     * 勤怠状況を取得する
     *
     * 出勤前、出勤中、休憩中、退勤後の4種類
     *
     * @return string 
     */

    public function getStatus(): string
    {
        if (!$this->isClockedIn()) {
            return 'off';
        }

        if ($this->isClockedOut()) {
            return 'done';
        }

        if ($this->isBreaking()) {
            return 'breaking';
        }

        return 'working';
    }

    /**
     * 合計休憩時間（分）の取得
     *
     * @return int
     */
    private function getTotalBreakMinutes(): int
    {
        return $this->attendanceBreakTimes->sum(function ($breakTime) {
            if (!$breakTime->break_end_at) {
                return 0;
            }
            return $breakTime->break_start_at->diffInMinutes($breakTime->break_end_at);
        });
    }

    /**
     * 合計休憩時間の取得
     *
     * @return string
     */
    public function getTotalBreakTime(): string
    {
        $totalMinutes = $this->getTotalBreakMinutes();
        return sprintf('%d:%02d', intdiv($totalMinutes, 60), $totalMinutes % 60);
    }

    /**
     * 合計労働時間の取得
     *
     * @return string
     */
    public function getTotalWorkTime(): string
    {
        if (!$this->clock_in_at || !$this->clock_out_at) {
            return '0:00';
        }

        $totalMinutes = $this->clock_in_at->diffInMinutes($this->clock_out_at);
        $workMinutes = $totalMinutes - $this->getTotalBreakMinutes();

        return sprintf('%d:%02d', intdiv($workMinutes, 60), $workMinutes % 60);
    }
}

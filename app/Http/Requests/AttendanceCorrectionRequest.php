<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceCorrectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'work_date' => 'required',
            'clock_in_at' => 'required|datetime|before:clock_out_at',
            'clock_out_at' => 'required|datetime|after:clock_in_at',
            'break_start_at[]' => 'required|datetime|after:clock_in_at|before:clock_out_at',
            'break_end_at[]' => 'required|datetime|before:clock_out_at',
            'remarks' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'clock_in_at.required'  => '出勤時間を入力してください',
            'clock_in_at.after'     => '休憩時間もしくは退勤時間が不適切な値です',
            'clock_out_at.required' => '退勤時間を入力してください',
            'clock_out_at.after'    => '出勤時間もしくは退勤時間が不適切な値です',
            'break_start_at.*.after' => '休憩時間が不適切な値です',
            'break_start_at.*.before' => '休憩時間が不適切な値です',
            'break_end_at.*.before'  => '休憩時間もしくは退勤時間が不適切な値です',
            'remarks.required'      => '備考を記入してください',
        ];
    }
}

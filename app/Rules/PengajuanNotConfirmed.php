<?php

namespace App\Rules;

use App\Models\PengajuanData;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PengajuanNotConfirmed implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!PengajuanData::find($value)->where('status_request', '=', 'Menunggu')->exists()) {
            $fail('Data pengajuan tidak tersedia');
        }
    }
}

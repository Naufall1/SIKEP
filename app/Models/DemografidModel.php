<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demografi extends Model
{
    use HasFactory;

    protected $table = 'demografi';
    protected $primaryKey = 'demografi_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'jenis',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

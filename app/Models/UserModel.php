<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'username',
        'password',
        'nama',
        'keterangan',
    ];

    public function level():BelongsTo    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    public function keluargaModified():HasMany {
        return $this->hasMany(KeluargaModified::class, 'user_id', 'user_id');
    }
}

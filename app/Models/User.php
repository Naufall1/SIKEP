<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level_id',
        'username',
        'password',
        'nama',
        'keterangan',
    ];

    public function hasRole($role){
        return $this->with('hasLevel')->where('level_kode', $role)->exists();
    }
    public function hasLevel():BelongsTo    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    public function keluargaModified():HasMany {
        return $this->hasMany(KeluargaModified::class, 'user_id', 'user_id');
    }
    public function demografi():HasMany
    {
        return $this->hasMany(Demografi::class, 'demografi_id', 'demografi_id');
    }
    public function user():HasMany
    {
        return $this->hasMany(ArticleAnnouncement::class, 'kode', 'kode');
    }
   
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleAnnouncement extends Model
{
    use HasFactory;

    protected $table = 'article_announcement';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'user_id',
        'kategori',
        'penulis',
        'tanggal_publish',
        'tanggal_dibuat',
        'tanggal_edit',
        'judul',
        'isi',
        'status',
        'image_url',
        'caption',
    ];

    public function getIncrementing(): bool
    {
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if ($model->kategori == 'Article') {
                $prefix = 'AR';
            } else {
                $prefix = 'AN';
            }

            $model->kode = $prefix . ($model::count() + 1);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}



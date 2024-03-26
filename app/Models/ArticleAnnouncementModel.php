<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleAnnouncementModel extends Model
{
    use HasFactory;
    protected $table = 'article_announcement';
    protected $primaryKey = 'kode';
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
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}


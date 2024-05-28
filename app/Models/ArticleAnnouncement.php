<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

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


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function getByAdmin(int $user_id, array $columns = ['*'])
    {
        $user = User::find($user_id);

        if ($user->level_id != 3) {
            return new Collection;
        }

        return $this->select($columns)
                ->where('user_id', '=', $user->user_id)
                ->get();
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Podcast extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'audio_url',
        'size',
        'description',
        'album_id',
        'title',
    ];

    protected $searchableFields = ['*'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->slug = rand(111,999).'-'.Str::slug($model->title);
        });
    }
}

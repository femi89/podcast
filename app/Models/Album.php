<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Album extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $slug = Str::slug($model->name);
            $model->slug = $slug.'-'.rand(111,999);
        });
    }
}

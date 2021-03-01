<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['podcast_id', 'guest_id', 'name', 'email', 'message'];

    protected $searchableFields = ['*'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}

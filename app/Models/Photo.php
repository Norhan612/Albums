<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $fillable = [
        'id',
        'name',
        'image',
        'album_id',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function album()
    {
        return $this->belongsTo(Album::class,'album_id');
    }
}

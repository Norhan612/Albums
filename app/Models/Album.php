<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    protected $fillable = [
        'id',
        'name',
        'logo',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id');
    }
}

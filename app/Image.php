<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'name', 'mime_type', 'size', 'witdh', 'height',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function imagePath()
    {
        return Storage::url($this->path);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\User;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['imageURL', 'gallery_id'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}

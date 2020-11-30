<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business_picture extends Model
{
    use HasFactory;
    protected $table = 'business_photos';
    protected $fillable = [
        'title', 'business_id'
    ];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }
}

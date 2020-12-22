<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }
}

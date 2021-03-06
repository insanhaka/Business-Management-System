<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'business';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_by = \Auth::user()->username;
        });
        static::updating(function ($model) {
            $model->updated_by = \Auth::user()->username;
        });
    }

    public function sector()
    {
        return $this->belongsTo('App\Models\Sector', 'business_sectors_id', 'id');
    }

    public function community()
    {
        return $this->belongsTo('App\Models\Community', 'community_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\Business_owner', 'business_owner_id', 'id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'business_id', 'id');
    }

    public function report()
    {
        return $this->hasMany('App\Models\Report', 'business_id', 'id');
    }
}

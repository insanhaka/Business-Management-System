<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
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

    public function category()
    {
        return $this->belongsTo('App\Models\Product_category', 'product_categories_id', 'id');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id', 'id');
    }
}

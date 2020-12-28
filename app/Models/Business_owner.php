<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business_owner extends Model
{
    use HasFactory;

    protected $table = 'business_owners';
    protected $fillable = ['id','name','nik','domisili_loc_province','domisili_loc_regency','domisili_loc_district','domisili_loc_village','domisili_address','ktp_loc_province','ktp_loc_regency','ktp_loc_district','ktp_loc_village','ktp_address'];

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

    public function business()
    {
        return $this->hasMany('App\Models\Business', 'business_owner_id', 'id');
    }
}

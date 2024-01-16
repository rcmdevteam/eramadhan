<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const UNPAID = 'unpaid';
    const PAID = 'paid';
    const FAILED = 'failed';

    protected $table = 'ramadhan_transactions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function masjid()
    {
        return $this->belongsTo(Masjid::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function ramadhan()
    {
        return $this->belongsTo(Ramadhan::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getHariAttribute()
    {
        return $this->attributes['ramadhan'];
    }
}

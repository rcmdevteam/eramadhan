<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamadhanTransaction extends Model
{
    use HasFactory;

    protected $table = 'ramadhan_transactions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['nama', 'emel', 'telefon', 'ramadhan', 'jumlah', 'kuantiti', 'status', 'ramadhan_id', 'toyyibpay_refno', 'toyyibpay_billcode', 'mark_as_paid'];
    // protected $hidden = [];
    // protected $dates = [];
}
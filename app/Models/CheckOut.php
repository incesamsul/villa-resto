<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'check_out';
    protected $guarded = ['id_check_out'];

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class, 'id_check_in', 'id_check_in');
    }
}

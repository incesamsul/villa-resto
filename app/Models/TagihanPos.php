<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPos extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pos';
    protected $guarded = ['id_tagihan_pos'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }
}

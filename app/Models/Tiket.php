<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = ['movie_id', 'customer_name', 'seat_number', 'kode_tiket', 'status'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

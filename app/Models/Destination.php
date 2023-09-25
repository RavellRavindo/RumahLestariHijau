<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    public function destinationPrice()
    {
        return $this->hasMany(DestinationPrice::class, "destination_id", "id");
    }
}

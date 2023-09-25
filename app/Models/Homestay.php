<?php

namespace App\Models;

use App\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;
    use FullTextSearch;

    protected $searchable = [
        'name',
        'location',
        'address'
    ];

    public function nearbyPlace()
    {
        return $this->hasMany(NearbyPlace::class, "homestay_id", "id");
    }

    public function popularPlace()
    {
        return $this->hasMany(PopularPlace::class, "homestay_id", "id");
    }

    public function homestayPhoto()
    {
        return $this->hasMany(HomestayPhoto::class, "homestay_id", "id");
    }

    public function commentList()
    {
        return $this->hasMany(CommentList::class, "table_id", "id");
    }
}

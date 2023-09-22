<?php

namespace App\Models;

use App\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    use HasFactory;
    use FullTextSearch;

    protected $searchable = [
        'name',
        'description'
    ];

    public function comment_list()
    {
        return $this->hasMany(CommentList::class, "table_id", "id");
    }
}

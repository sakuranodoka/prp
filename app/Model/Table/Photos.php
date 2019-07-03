<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model {
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'events_id', 'name', 'filename', 'location', 'detail', 'status'
    ];
}

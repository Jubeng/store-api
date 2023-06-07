<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreModel
 */
class StoreModel extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'store';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
    ];
}

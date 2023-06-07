<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * timestamp option
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'store_id',
        'inventory_quantity',
        'inventory_updated_time'
    ];
}

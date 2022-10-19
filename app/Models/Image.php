<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'name',
        'path',
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $guarded = [];
    
    /**
     * Get the user that owns the Level
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}

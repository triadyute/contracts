<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    protected $casts = [
        'changes' => 'array'
    ];
    
    public function contracts()
    {
        return $this->belongsToMany(\App\Contract::class);
    }
}

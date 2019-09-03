<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'sector', 'number_of_employees'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}

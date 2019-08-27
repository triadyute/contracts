<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'supplier', 'company_id', 'alert_date', 'add_to_calendar', 'primary_contact', 'reference', 'category', 'currency', 'contract_value', 'contract_period', 'start_date', 'notice_period', 'end_date', 'no_end_date', 'created_by', 'visible_to', 'secondary_contact', 'notes', 'link', 'google_link'
    ];

    protected $casts = [
        'visible_to' => 'array'
    ];
    
    public function users()
    {
	    return $this->belongsToMany('App\User', 'contract_users', 'contract_id', 'user_id');
    }

    public function changelog()
    {
	    return $this->hasOne(\App\ChangeLog::class);
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsTrainingSession extends Model
{
    use HasFactory;
     // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'max_users',
        'level',
        'training_dates',
        'ps_skill_id',
        'trainer_id',
        'created_by',
        'updated_by',
      
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    // public function account_type() 
	// {
	// 	return $this->belongsTo('App\Models\TerminalEntryPoint');
    // }
}

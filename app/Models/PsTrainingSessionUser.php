<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsTrainingSessionUser extends Model
{
    use HasFactory;
      // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'traninig_session_id',
        'user_id',
        'registred_for_traning',
        'registred_for_traning_at',
        'acquired',
        'acquired_at',
      
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

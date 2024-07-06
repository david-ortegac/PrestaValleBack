<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Interest
 *
 * @property $id
 * @property $interest
 * @property $state
 * @property $created_by
 * @property $modified_by
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Interest extends Model
{
    
    static $rules = [
		'interest' => 'required',
		'state' => 'required',
		'created_by' => 'required',
		'modified_by' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['interest','state','created_by','modified_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function created_by()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function modified_by()
    {
        return $this->hasOne('App\Models\User', 'id', 'modified_by');
    }
    

}
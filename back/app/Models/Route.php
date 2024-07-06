<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Route
 *
 * @property $id
 * @property $sede_id
 * @property $number
 * @property $created_by
 * @property $modified_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Client[] $clients
 * @property Sede $sede
 * @property User $createdBy
 * @property User $modifiedBy
 * @package App
 * @mixin Builder
 */
class Route extends Model
{
    use HasFactory;

    static array $rules = [
        'sede_id' => 'required',
        'name' => 'required'
    ];

    protected $perPage = 20;

    protected $hidden = [
        'created_by',
        'modified_by',
        'sede_id'
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sede_id',
        'name',
        'created_by',
        'modified_by',
    ];

    /**
     * @return HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany('App\Models\Client', 'route_id', 'id');
    }


    /**
     * @return HasOne
     */
    public function sede(): HasOne
    {
        return $this->hasOne('App\Models\Sede', 'id', 'sede_id')
        ->select(array('id','name'));
    }

    /**
     * @return HasOne
     */
    public function createdBy(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by')
        ->select(array('name','email'));
    }

    /**
     * @return HasOne
     */
    public function modifiedBy(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'modified_by')
        ->select(array('name','email'));
    }

}

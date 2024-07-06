<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Sede
 *
 * @property $id
 * @property $name
 * @property $created_by
 * @property $modified_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Route[] $routes
 * @property User $createdBy
 * @property User $modifiedBy
 * @package App
 * @mixin Builder
 */
class Sede extends Model
{
    use HasFactory;

    static array $rules = [
        'name' => 'required',
    ];

    protected $perPage = 20;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'created_by',
        'modified_by',
    ];

    /**
     * @return HasMany
     */
    public function routes(): HasMany
    {
        return $this->hasMany('App\Models\Route', 'sede_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function modifiedBy(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'modified_by')
            ->select(array('name', 'email'));
    }

    /**
     * @return HasOne
     */
    public function createdBy(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by')
            ->select(array('name', 'email'));
    }

}

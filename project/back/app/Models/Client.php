<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Client
 *
 * @property $id
 * @property $route_id
 * @property $document_type
 * @property $document_number
 * @property $name
 * @property $last_name
 * @property $email
 * @property $phone
 * @property $neighborhood
 * @property $address
 * @property $city
 * @property $profession
 * @property $notes
 * @property $type
 * @property $created_by
 * @property $modified_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Loan[] $loans
 * @property Route $route
 * @property User $createdBy
 * @property User $modifiedBy
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{
    use HasFactory;

    static array $rules = [
        'document_type' => 'required',
        'document_number' => 'required',
        'name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'neighborhood' => 'required',
        'address' => 'required',
        'city' => 'required',
        'profession' => 'required'
    ];

    protected $perPage = 20;

    protected $hidden = [
        'created_by',
        'modified_by',
        'route_id',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_type',
        'document_number',
        'route_id',
        'name',
        'last_name',
        'phone',
        'neighborhood',
        'address',
        'city',
        'profession',
        'notes',
        'type',
        'created_by',
        'modified_by',
    ];

    /**
     * @return HasMany
     */
    public function loans(): HasMany
    {
        return $this->hasMany('App\Models\Loan', 'client_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function route()
    {
        return $this->hasOne('App\Models\Route', 'id', 'route_id')
        ->select(array('id','number','sede_id'));
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

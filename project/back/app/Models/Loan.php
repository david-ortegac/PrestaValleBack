<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 *
 * @property $id
 * @property $route_id
 * @property $client_id
 * @property $amount
 * @property $paymentDays
 * @property $paymentType
 * @property $deposit
 * @property $lastInstallment
 * @property $remainingBalance
 * @property $remainingAmount
 * @property $daysPastDue
 * @property $lastPayment
 * @property $startDate
 * @property $finalDate
 * @property $created_by
 * @property $modified_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Client $client
 * @property User $createdBy
 * @property User $modifiedBy
 * @property Route $route
 * @property SpreadSheet[] $spreadSheets
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Loan extends Model
{

    use HasFactory;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = [
        'route_id',
        'client_id',
        'amount',
        'paymentDays',
        'paymentType',
        'deposit',
        'lastInstallment',
        'remainingBalance',
        'remainingAmount',
        'daysPastDue',
        'lastPayment',
        'startDate',
        'finalDate',
        'status',
        'created_by',
        'modified_by'
    ];
=======
    protected $fillable = ['route_id', 'client_id', 'amount', 'paymentDays', 'paymentType', 'deposit', 'lastInstallment', 'remainingBalance', 'remainingAmount', 'daysPastDue', 'lastPayment', 'startDate', 'finalDate', 'created_by', 'modified_by'];
>>>>>>> d8914f2 (ajustes)

    protected $hidden=[
        'route_id',
        'client_id',
        'created_by',
        'modified_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id')
            ->select(array('id', 'name', 'last_name'));
=======
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
>>>>>>> d8914f2 (ajustes)
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id')
            ->select(array('name', 'email'));
=======
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
>>>>>>> d8914f2 (ajustes)
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modifiedBy()
    {
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id')
            ->select(array('name', 'email'));
=======
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id');
>>>>>>> d8914f2 (ajustes)
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id')
            ->select(array('id', 'name'));
=======
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id');
>>>>>>> d8914f2 (ajustes)
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spreadSheets()
    {
        return $this->hasMany(\App\Models\SpreadSheet::class, 'id', 'loan_id');
    }


}

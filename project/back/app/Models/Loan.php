<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Loan
 *
 * @property $id
 * @property $route_id
 * @property $client_id
 * @property $order
 * @property $amount
 * @property $dailyPayment
 * @property $daysToPay
 * @property $paymentDays
 * @property $deposit
 * @property $pico
 * @property $date
 * @property $daysPastDue
 * @property $balance
 * @property $dues
 * @property $lastPayment
 * @property $startDate
 * @property $finalDate
 * @property $status
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

    protected $perPage = 20;

    protected $hidden=[
        'route_id',
        'client_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
    protected $fillable = [
        'route_id',
        'client_id',
        'order',
        'amount',
        'dailyPayment',
        'daysToPay',
        'paymentDays',
        'deposit',
        'pico',
        'date',
        'daysPastDue',
        'balance',
        'dues',
        'lastPayment',
        'startDate',
        'finalDate',
        'status',
        'created_by',
        'modified_by'
    ];
<<<<<<< HEAD
=======
    protected $fillable = ['route_id', 'client_id', 'amount', 'paymentDays', 'paymentType', 'deposit', 'lastInstallment', 'remainingBalance', 'remainingAmount', 'daysPastDue', 'lastPayment', 'startDate', 'finalDate', 'created_by', 'modified_by'];
>>>>>>> d8914f2 (ajustes)
=======
>>>>>>> ce2e761 (Ajustes loans front y back)


    /**
     * @return BelongsTo
     */
    public function client()
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id')
            ->select(array('id', 'name', 'last_name'));
=======
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
>>>>>>> d8914f2 (ajustes)
=======
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id')
            ->select(array('id', 'name', 'last_name'));
>>>>>>> ce2e761 (Ajustes loans front y back)
=======
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
>>>>>>> 561527c (ajustes loand back y model front)
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id')
            ->select(array('name', 'email'));
=======
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
>>>>>>> d8914f2 (ajustes)
=======
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id')
            ->select(array('name', 'email'));
>>>>>>> ce2e761 (Ajustes loans front y back)
    }

    /**
     * @return BelongsTo
     */
    public function modifiedBy(): BelongsTo
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id')
            ->select(array('name', 'email'));
=======
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id');
>>>>>>> d8914f2 (ajustes)
=======
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id')
            ->select(array('name', 'email'));
>>>>>>> ce2e761 (Ajustes loans front y back)
    }

    /**
     * @return BelongsTo
     */
    public function route(): BelongsTo
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id')
            ->select(array('id', 'name'));
=======
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id');
>>>>>>> d8914f2 (ajustes)
=======
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id')
            ->select(array('id', 'name'));
>>>>>>> ce2e761 (Ajustes loans front y back)
=======
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id');
>>>>>>> 561527c (ajustes loand back y model front)
    }

    /**
     * @return HasMany
     */
    public function spreadSheets(): HasMany
    {
        return $this->hasMany(\App\Models\SpreadSheet::class, 'id', 'loan_id');
    }

}

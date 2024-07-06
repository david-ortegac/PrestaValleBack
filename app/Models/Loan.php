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


    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id')
            ->select(array('name', 'email'));
    }

    /**
     * @return BelongsTo
     */
    public function modifiedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'modified_by', 'id')
            ->select(array('name', 'email'));
    }

    /**
     * @return BelongsTo
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Route::class, 'route_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * @return HasMany
     */
    public function spreadSheets(): HasMany
    {
        return $this->hasMany(\App\Models\SpreadSheet::class, 'id', 'loan_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class SpreadSheet
 *
 * @property $id
 * @property $loan_id
 * @property $client_id
 * @property $loandDate
 * @property $payment
 * @property $created_at
 * @property $updated_at
 *
 * @property Client $client
 * @property Loan $loan
 * @property User $createdBy
 * @property User $modifiedBy
 * @package App
 * @mixin Builder
 */
class SpreadSheet extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['loan_id', 'client_id', 'loandDate', 'payment','created_by', 'modified_by',];


    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Loan::class, 'loan_id', 'id');
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

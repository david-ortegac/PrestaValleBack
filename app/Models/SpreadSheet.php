<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SpreadSheet
 *
 * @property $id
 * @property $loan_id
 * @property $client_id
 * @property $generationDate
 * @property $loandDate
 * @property $payment
 * @property $created_at
 * @property $updated_at
 *
 * @property Client $client
 * @property Loan $loan
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
    protected $fillable = ['loan_id', 'client_id', 'generationDate', 'loandDate', 'payment'];


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

}

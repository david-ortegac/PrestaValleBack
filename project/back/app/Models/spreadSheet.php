<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Illuminate\Database\Eloquent\Builder
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo(\App\Models\Loan::class, 'loan_id', 'id');
    }
    
}

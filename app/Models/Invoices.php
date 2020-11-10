<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string     $series
 * @property string     $sequence
 * @property int        $seller_id
 * @property int        $buyer_id
 * @property Date       $date
 * @property int        $until_days
 * @property string     $currency_symbol
 * @property string     $currency_code
 * @property string     $notes
 * @property int        $created_at
 * @property int        $updated_at
 */
class Invoices extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'series', 'sequence', 'seller_id', 'buyer_id', 'date', 'until_days', 'currency_symbol', 'currency_code', 'notes', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'series' => 'string', 'sequence' => 'string', 'seller_id' => 'int', 'buyer_id' => 'int', 'date' => 'date', 'until_days' => 'int', 'currency_symbol' => 'string', 'currency_code' => 'string', 'notes' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buyer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'buyer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seller()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lines()
    {
        return $this->hasMany('App\Models\InvoiceLines', 'invoice_id', 'id');
    }
}

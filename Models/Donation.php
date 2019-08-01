<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Donation
 * @package App\Models
 * @version July 19, 2019, 11:23 am UTC
 *
 * @property string Donated_By
 * @property integer Amount
 * @property string Date
 */
class Donation extends Model
{
    use SoftDeletes;

    public $table = '_donations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Donated_By',
        'Amount',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Donated_By' => 'string',
        'Amount' => 'integer',
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Donated_By' => 'required',
        'Amount' => 'required',
        
    ];

    
}

<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fund
 * @package App\Models
 * @version July 19, 2019, 11:23 am UTC
 *
 * @property string Source
 * @property integer Amount
 * @property string Date
 */
class Fund extends Model
{
    use SoftDeletes;

    public $table = '_funds';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Source',
        'Amount',
  
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Source' => 'string',
        'Amount' => 'integer',
      
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Source' => 'required',
        'Amount' => 'required',
        
    ];

    
}

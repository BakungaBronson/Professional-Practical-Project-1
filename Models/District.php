<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class District
 * @package App\Models
 * @version July 19, 2019, 11:30 am UTC
 *
 * @property string District_Code
 * @property string District_Name
 * @property integer Number_of_Agents
 */
class District extends Model
{
    use SoftDeletes;

    public $table = '_districts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'District_Code',
        'District_Name',
        'Number_of_Agents'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'District_Code' => 'string',
        'District_Name' => 'string',
        'Number_of_Agents' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'District_Code' => 'required',
        'District_Name' => 'required',
        'Number_of_Agents' => 'required'
    ];

    
}

<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Agent
 * @package App\Models
 * @version July 19, 2019, 11:21 am UTC
 *
 * @property string Name
 * @property string SEX
 * @property integer Contact
 * @property string Roles
 * @property string Signature
 * @property string District_Assigned
 */
class Agent extends Model
{
    use SoftDeletes;

    public $table = '_agents';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Name',
        'SEX',
        'Contact',
        'Roles',
        'Signature',
        'District_Assigned'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Name' => 'string',
        'SEX' => 'string',
        'Contact' => 'integer',
        'Roles' => 'string',
        'Signature' => 'string',
        'District_Assigned' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Name' => 'required',
        'SEX' => 'required',
        'Contact' => 'required',
        'Signature' => 'required',
        
    ];

    
}

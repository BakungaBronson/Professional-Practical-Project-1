<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 * @package App\Models
 * @version July 19, 2019, 11:22 am UTC
 *
 * @property string MemberID
 * @property string Name
 * @property string Sex
 * @property integer Contact
 * @property string Recommended_By
 * @property string District
 * @property string Agent
 * @property string Date
 */
class Member extends Model
{
    use SoftDeletes;

    public $table = '_members';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = [
        'date',
        'created_at',
        'deleted_at'
    ];


    public $fillable = [
        'MemberID',
        'Name',
        'Sex',
        'Contact',
        'Recommended_By',
        'District',
        'Agent',
       
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'MemberID' => 'string',
        'Name' => 'string',
        'Sex' => 'string',
        'Contact' => 'integer',
        'Recommended_By' => 'string',
        'District' => 'string',
        'Agent' => 'string',
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'MemberID' => 'required',
        'Name' => 'required',
        'Sex' => 'required',
        'Contact' => 'required',
        'Recommended_By' => 'required',
        'District' => 'required',
        'Agent' => 'required',
        
    ];

    public function getDates(){
        return array();
    }

}

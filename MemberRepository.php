<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\BaseRepository;

/**
 * Class MemberRepository
 * @package App\Repositories
 * @version July 19, 2019, 11:22 am UTC
*/

class MemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'MemberID',
        'Name',
        'Sex',
        'Contact',
        'Recommended_By',
        'District',
        'Agent',
        'Date'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Member::class;
    }
}

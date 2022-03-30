<?php

namespace Webkul\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Traits\CustomAttribute;
use Webkul\Contact\Contracts\Organization as OrganizationContract;

class Organization extends Model implements OrganizationContract
{
    use CustomAttribute;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_entity',
        'business_classification',
        'fein',
        'year_business_started',
        'number_of_employees',
        'annual_revenue',
        'payroll',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BillPay extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    protected $fillable = [
        'name',
        'date_due',
        'value',
        'done',
        'category_id'
    ];

    protected $casts = [
        'done' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

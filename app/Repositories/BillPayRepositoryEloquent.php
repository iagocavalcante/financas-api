<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BillPayRepository;
use App\Models\BillPay;
use App\Validators\BillPayValidator;
use App\Presenters\BillPayPresenter;

/**
 * Class BillPayRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillPay::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BillPayPresenter::class;
    }

    public function applyMultitenancy()
    {
        BillPay::clearBootedModels();
    }

    public function calculateTotal()
    {
        $result = [
            'count' => 0,
            'count_paid' => 0,
            'total_be_paid' => 0
        ];
        $billpays = $this->skipPresenter()->all();
        $result['count'] = $billpays->count();
        foreach($billpays as $billpay) {
            $done = (bool) $billpay->done;
            if($done) {
                $result['count_paid']++;
            } else {
                $value = (float) $billpay->value;
                $result['total_be_paid']+= $value;
            }
        }

        return $result;
    }
}

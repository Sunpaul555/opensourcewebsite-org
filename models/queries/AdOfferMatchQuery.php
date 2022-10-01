<?php

declare(strict_types=1);

namespace app\models\queries;

use app\models\User;
use Yii;
use yii\db\ActiveQuery;

/**
 * Class AdOfferMatchQuery
 *
 * @package app\models\queries
 */
class AdOfferMatchQuery extends ActiveQuery
{
    /**
     * @return self
     */
    public function orderByRank(): self
    {
        return $this->joinWith('adSearch.user')
            ->orderBy([
                User::tableName() . '.rating' => SORT_DESC,
                User::tableName() . '.created_at' => SORT_ASC,
            ]);
    }
}

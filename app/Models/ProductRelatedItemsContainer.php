<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class represents class-container. Class container has collection of product related items.
 *
 * @property Collection $items
 */
class ProductRelatedItemsContainer extends Model
{
    public function getItemByRelatedId(string $relatedField, int $relatedId)
    {
        return $this->items->where($relatedField, '=', $relatedId)->first();
    }
}

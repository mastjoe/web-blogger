<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

trait Sortable 
{
    /**
     * sorts a single column of a model table
     *
     * @param Builder $query
     * @param string $column
     * @param string $order
     * @return Builder
     */
    public function scopeSortColumn(Builder $query, $column, $order ="desc") :Builder
    {
        return $query->orderBy($column, $order);
    }

    /**
     * sorts multiple columns of a model table
     *
     * @param Builder $query
     * @param array $sorts
     * @return Builder
     */
    public function scopeSortColumns(Builder $query, array $sorts) :Builder
    {
        $orders = ["asc", "desc"];

        foreach ($sorts as $column => $by) {

            if (!in_array(strtolower($by), $orders)) {
                throw new InvalidArgumentException("Invalid sort order $by");
            }
            
            $query->orderBy($column, $by);
        }

        return $query;
    }
}
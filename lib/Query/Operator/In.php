<?php

namespace Spot\Query\Operator;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Spot\Exception;

/**
 * @package Spot\Query\Operator
 */
class In
{
    /**
     * @param QueryBuilder $builder
     * @param $column
     * @param $value
     * @throws Exception
     * @return string
     */
    public function __invoke(QueryBuilder $builder, $column, $value)
    {
        if (!is_array($value)) {
            throw new Exception("Use of IN operator expects value to be array. Got " . gettype($value) . ".");
        }

        $valueIn = "";
        foreach ($value as $val) {
            $valueIn .= $builder->createPositionalParameter($val) . ",";
        }
        return $column . ' IN (' . trim($valueIn, ',') . ')';
    }
}

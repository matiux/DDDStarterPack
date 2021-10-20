<?php

declare(strict_types=1);

namespace DDDStarterPack\Aggregate\Infrastructure\Doctrine\Repository\Filter;

use DDDStarterPack\Aggregate\Domain\Repository\Filter\FilterParams;
use DDDStarterPack\Aggregate\Domain\Repository\Filter\FilterParamsApplier;
use Doctrine\ORM\QueryBuilder;

/**
 * @implements FilterParamsApplier<QueryBuilder>
 */
abstract class DoctrineFilterParamsApplier implements FilterParamsApplier
{
    /**
     * @param QueryBuilder $target
     * @param FilterParams $filterParams
     */
    abstract public function apply($target, FilterParams $filterParams): void;
}

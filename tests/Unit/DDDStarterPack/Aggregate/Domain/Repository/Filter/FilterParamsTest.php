<?php

declare(strict_types=1);

namespace Tests\Unit\DDDStarterPack\Aggregate\Domain\Repository\Filter;

use DDDStarterPack\Aggregate\Domain\Repository\Filter\FilterApplierRegistry;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FilterParamsTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_throw_exception_if_two_filter_params_applier_have_same_key(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Applier for key \'name\' is already set');

        $neededFilters = [
            'name' => 'Matteo',
            'skills' => ['architecture', 'programming'],
        ];

        $filterParamsApplyer = [
            new DummyFilterApplier('name'),
            new DummyFilterApplier('name'),
        ];

        new FilterApplierRegistry($filterParamsApplyer, $neededFilters);
    }

    /**
     * @test
     */
    public function it_should_throw_exception_if_key_does_not_exist(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage("Filter with key 'surname' does not exist");

        $neededFilters = [
            'name' => 'Matteo',
            'skills' => ['architecture', 'programming'],
        ];

        $filterParams = new FilterApplierRegistry([], $neededFilters);

        $filterParams->getFilterValueForKey('surname');
    }

    /**
     * @test
     */
    public function it_should_verify_if_key_exists(): void
    {
        $neededFilters = [
            'name' => 'Matteo',
        ];

        $filterParams = new FilterApplierRegistry([], $neededFilters);

        self::assertFalse($filterParams->hasFilterWithKey('surname'));
    }
}

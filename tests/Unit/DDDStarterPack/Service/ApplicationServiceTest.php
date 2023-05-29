<?php

declare(strict_types=1);

namespace Tests\Unit\DDDStarterPack\Service;

use DDDStarterPack\Service\ApplicationService;
use PHPUnit\Framework\TestCase;

class ApplicationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function user_service(): void
    {
        $service = new MyApplicationService();

        // Psalm gets angry - as it should be
        // $service->execute(new \stdClass());

        $result = $service->execute(new MyApplicationRequest());

        self::assertNotEmpty($result);
        self::assertArrayHasKey('foo', $result);
    }
}

/**
 * @implements ApplicationService<MyApplicationRequest, array>
 */
class MyApplicationService implements ApplicationService
{
    /**
     * @param MyApplicationRequest $request
     *
     * @return array
     */
    public function execute($request): array
    {
        return $request->getData();
    }
}

class MyApplicationRequest
{
    public function getData(): array
    {
        return ['foo' => 'bar'];
    }
}

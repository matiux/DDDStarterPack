<?php

declare(strict_types=1);

namespace Tests\Unit\DDDStarterPack\Aggregate\Domain;

use DDDStarterPack\Aggregate\Domain\BasicEntityId;
use PHPUnit\Framework\TestCase;

class BasicEntityIdTest extends TestCase
{
    /**
     * @test
     */
    public function create_randomic_uuid(): void
    {
        $myId = MyId::create();

        $entity = new class($myId) {
            /** @var MyId */
            private $id;

            public function __construct(MyId $id)
            {
                $this->id = $id;
            }

            public function id(): MyId
            {
                return $this->id;
            }
        };

        self::assertInstanceOf(MyId::class, $entity->id());
        self::assertMatchesRegularExpression(BasicEntityId::UUID_PATTERN, (string) $entity->id());
    }

    /**
     * @test
     */
    public function create_specific_uuid(): void
    {
        $myId = MyId::createFrom('79fe4c6b-87f6-4093-98f9-ce6a193ab2a5');

        self::assertEquals('79fe4c6b-87f6-4093-98f9-ce6a193ab2a5', $myId->id());
        self::assertIsString($myId->id());
    }

    /**
     * @test
     */
    public function create_numeric_id(): void
    {
        $myId = MyId::createFrom(5);

        self::assertEquals(5, $myId->id());
        self::assertIsInt($myId->id());
    }

    /**
     * @test
     */
    public function create_null_id(): void
    {
        $myId = MyId::createNull();

        self::assertTrue($myId->isNull());
        self::assertNull($myId->id());
    }
}

class MyId extends BasicEntityId
{
}

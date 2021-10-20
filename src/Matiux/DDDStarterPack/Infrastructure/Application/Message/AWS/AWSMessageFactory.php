<?php

declare(strict_types=1);

namespace DDDStarterPack\Infrastructure\Application\Message\AWS;

use DateTimeImmutable;
use DDDStarterPack\Application\Message\MessageFactory;

/**
 * @implements MessageFactory<AWSMessage>
 */
class AWSMessageFactory implements MessageFactory
{
    public function build(
        string $body,
        null|string $exchangeName = null,
        null|DateTimeImmutable $occurredAt = null,
        null|string $type = null,
        null|string $id = null,
        array $extra = [],
    ) {
        return new AWSMessage(
            body: $body,
            occurredAt: $occurredAt,
            type: $type,
            id: $id,
            extra: $extra
        );
    }
}

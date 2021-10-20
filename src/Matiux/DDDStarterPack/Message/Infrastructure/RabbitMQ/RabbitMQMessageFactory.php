<?php

declare(strict_types=1);

namespace DDDStarterPack\Message\Infrastructure\RabbitMQ;

use DateTimeImmutable;
use DDDStarterPack\Message\Application\MessageFactory;

/**
 * Class RabbitMQMessageFactory.
 *
 * @implements MessageFactory<RabbitMQMessage>
 */
class RabbitMQMessageFactory implements MessageFactory
{
    public function build(string $body, string $exchangeName = null, DateTimeImmutable $occurredAt = null, string $type = null, string $id = null)
    {
        return new RabbitMQMessage($body, $exchangeName, $occurredAt, $type, $id);
    }
}

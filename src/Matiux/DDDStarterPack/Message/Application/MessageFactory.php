<?php

declare(strict_types=1);

namespace DDDStarterPack\Message\Application;

use DateTimeImmutable;

/**
 * @template T of Message
 */
interface MessageFactory
{
    /**
     * @param string                 $body
     * @param null|string            $exchangeName
     * @param null|DateTimeImmutable $occurredAt
     * @param null|string            $type
     * @param null|string            $id
     *
     * @return T
     */
    public function build(string $body, string $exchangeName = null, DateTimeImmutable $occurredAt = null, string $type = null, string $id = null);
}

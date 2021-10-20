<?php

declare(strict_types=1);

namespace Tests\Support\Model\Doctrine;

use DDDStarterPack\Aggregate\Infrastructure\Doctrine\DoctrineEntityId;
use Tests\Support\Model\PersonId;

class DoctrinePersonId extends DoctrineEntityId
{
    public function getName()
    {
        return 'PersonId';
    }

    protected function getFQCN(): string
    {
        return PersonId::class;
    }
}

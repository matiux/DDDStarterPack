<?php

declare(strict_types=1);

namespace DDDStarterPack\Message\Driver\AWS;

use Aws\Credentials\Credentials;
use Aws\Result;
use Webmozart\Assert\Assert;

trait AWSBasicService
{
    protected function specificDriverName(): string
    {
        return self::NAME;
    }

    /**
     * @psalm-return list<string>
     */
    protected function requiredParams(): array
    {
        return ['region'];
    }

    protected function customDefaultsParams(): array
    {
        return [
            'debug' => false,
            'version' => 'latest',
            'access_key' => '',
            'secret_key' => '',
            'retries' => 3,
        ];
    }

    private function createCredentials(): array
    {
        $accessKey = $this->configuration->accessKey();
        $secretKey = $this->configuration->secretKey();

        if (\is_string($accessKey) && \is_string($secretKey)) {
            $credentials = new Credentials($accessKey, $secretKey);

            return ['credentials' => $credentials];
        }

        return [];
    }

    /**
     * @param string $exchangeName
     *
     * @codeCoverageIgnore
     */
    public function open(string $exchangeName = ''): void
    {
        throw new \BadMethodCallException();
    }

    /**
     * @param string $exchangeName
     *
     * @codeCoverageIgnore
     */
    public function close(string $exchangeName = ''): void
    {
        throw new \BadMethodCallException();
    }

    public static function obtainStatusCode(Result $result): int
    {
        Assert::isArray($result['@metadata']);

        return (int) $result['@metadata']['statusCode'];
    }

    public static function isAwsResultValid(Result $result): bool
    {
        return 200 === self::obtainStatusCode($result);
    }
}

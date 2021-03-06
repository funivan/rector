<?php declare(strict_types=1);

namespace Rector\NetteToSymfony\Tests\Rector\MethodCall\FromHttpRequestGetHeaderToHeadersGetRector;

use Rector\NetteToSymfony\Rector\MethodCall\FromHttpRequestGetHeaderToHeadersGetRector;
use Rector\NetteToSymfony\Tests\Rector\MethodCall\FromHttpRequestGetHeaderToHeadersGetRector\Source\NetteHttpRequest;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class FromHttpRequestGetHeaderToHeadersGetRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFiles([__DIR__ . '/Fixture/fixture.php.inc', __DIR__ . '/Fixture/missing_argument.php.inc']);
    }

    /**
     * @return mixed[]
     */
    protected function getRectorsWithConfiguration(): array
    {
        return [
            FromHttpRequestGetHeaderToHeadersGetRector::class => [
                '$netteHttpRequestClass' => NetteHttpRequest::class,
            ],
        ];
    }
}

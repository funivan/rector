<?php declare(strict_types=1);

namespace Rector\Php\Tests\Rector\BinaryOp\IsCountableRector;

use Rector\Configuration\Option;
use Rector\Php\Rector\BinaryOp\IsCountableRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\PackageBuilder\Parameter\ParameterProvider;

final class PolyfillRectorTest extends AbstractRectorTestCase
{
    /**
     * @var string|null
     */
    private $originalPhpVersionFeaturesParameter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parameterProvider = self::$container->get(ParameterProvider::class);
        $this->originalPhpVersionFeaturesParameter = $this->parameterProvider->provideParameter(
            Option::PHP_VERSION_FEATURES
        );

        $this->parameterProvider->changeParameter(Option::PHP_VERSION_FEATURES, '7.2');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->parameterProvider->changeParameter(
            Option::PHP_VERSION_FEATURES,
            $this->originalPhpVersionFeaturesParameter
        );
    }

    public function test(): void
    {
        $this->doTestFiles([__DIR__ . '/Fixture/polyfill_function.php.inc']);
    }

    public function getRectorClass(): string
    {
        return IsCountableRector::class;
    }
}

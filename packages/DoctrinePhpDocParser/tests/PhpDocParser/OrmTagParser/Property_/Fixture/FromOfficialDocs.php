<?php declare(strict_types=1);

namespace Rector\DoctrinePhpDocParser\Tests\PhpDocParser\OrmTagParser\Property_\Fixture;

use Doctrine\ORM\Mapping as ORM;

final class FromOfficialDocs
{
    /**
     * @ORM\Column(type="integer", name="login_count", nullable=false, options={"unsigned":true, "default":0}, columnDefinition="CHAR(2) NOT NULL")
     */
    private $loginCount;
}

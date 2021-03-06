<?php declare(strict_types=1);

namespace Rector\TypeDeclaration\Contract\TypeInferer;

use PhpParser\Node\Param;

interface ParamTypeInfererInterface
{
    /**
     * @return string[]
     */
    public function inferParam(Param $param): array;
}

<?php declare(strict_types=1);

namespace Rector\CodingStyle\Imports;

use Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Namespace_;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PhpParser\NodeTraverser\CallableNodeTraverser;

final class ShortNameResolver
{
    /**
     * @var CallableNodeTraverser
     */
    private $callableNodeTraverser;

    /**
     * @var string[][]
     */
    private $shortNamesByNamespaceObjectHash = [];

    public function __construct(CallableNodeTraverser $callableNodeTraverser)
    {
        $this->callableNodeTraverser = $callableNodeTraverser;
    }

    /**
     * @return string[]
     */
    public function resolveForNode(Node $node): array
    {
        /** @var Namespace_|null $namespace */
        $namespace = $node->getAttribute(AttributeKey::NAMESPACE_NODE);

        if ($namespace === null) {
            return [];
        }

        $namespaceHash = spl_object_hash($namespace);
        if (isset($this->shortNamesByNamespaceObjectHash[$namespaceHash])) {
            return $this->shortNamesByNamespaceObjectHash[$namespaceHash];
        }

        if ($namespace instanceof Namespace_) {
            $shortNames = $this->resolveForNamespace($namespace);
            $this->shortNamesByNamespaceObjectHash[$namespaceHash] = $shortNames;
            return $shortNames;
        }

        return [];
    }

    /**
     * @return string[]
     */
    private function resolveForNamespace(Namespace_ $node): array
    {
        $shortNames = [];

        $this->callableNodeTraverser->traverseNodesWithCallable($node->stmts, function (Node $node) use (
            &$shortNames
        ): void {
            if (! $node instanceof Name) {
                return;
            }

            $originalName = $node->getAttribute('originalName');
            if (! $originalName instanceof Name) {
                return;
            }

            // already short
            if (Strings::contains($originalName->toString(), '\\')) {
                return;
            }

            $shortNames[$originalName->toString()] = $node->toString();
        });

        return $shortNames;
    }
}

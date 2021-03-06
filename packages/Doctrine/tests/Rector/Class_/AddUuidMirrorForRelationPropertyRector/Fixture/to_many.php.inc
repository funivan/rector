<?php

namespace Rector\Doctrine\Tests\Rector\Class_\AddUuidMirrorForRelationPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ToMany
{
    /**
     * @ORM\ManyToMany(targetEntity="Rector\Doctrine\Tests\Rector\Class_\AddUuidMirrorForRelationPropertyRector\Source\AnotherEntity", cascade={"persist", "merge"})
     */
    private $amenity;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Class_\AddUuidMirrorForRelationPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ToMany
{
    /**
     * @ORM\ManyToMany(targetEntity="Rector\Doctrine\Tests\Rector\Class_\AddUuidMirrorForRelationPropertyRector\Source\AnotherEntity", cascade={"persist", "merge"})
     */
    private $amenity;
    /**
     * @ORM\ManyToMany(targetEntity="Rector\Doctrine\Tests\Rector\Class_\AddUuidMirrorForRelationPropertyRector\Source\AnotherEntity", cascade={"persist", "merge"})
     * @ORM\JoinTable (name="tomany_uuid_anotherentity_uuid", joinColumns={@ORM\JoinColumn(referencedColumnName="uuid")}, inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="uuid")})
     */
    private $amenityUuid;
}

?>

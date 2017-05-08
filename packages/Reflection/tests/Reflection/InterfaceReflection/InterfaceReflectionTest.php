<?php declare(strict_types=1);

namespace ApiGen\Reflection\Tests\Reflection\InterfaceReflection;

use ApiGen\Reflection\Contract\Reflection\InterfaceReflectionInterface;
use ApiGen\Reflection\Tests\Reflection\InterfaceReflection\Source\RichInterface;
use ApiGen\Tests\AbstractParserAwareTestCase;

final class InterfaceReflectionTest extends AbstractParserAwareTestCase
{
    /**
     * @var InterfaceReflectionInterface
     */
    private $interfaceReflection;

    protected function setUp(): void
    {
        $this->parser->parseDirectories([__DIR__ . '/Source']);

        $interfaceReflections = $this->parser->getInterfaceReflections();
        $this->interfaceReflection = $interfaceReflections[2];
    }

    public function testExists()
    {
        $this->assertInstanceOf(InterfaceReflectionInterface::class, $this->interfaceReflection);
    }

    public function testImplementsInterface(): void
    {
        $this->assertFalse($this->interfaceReflection->implementsInterface('NoInterface'));
        $this->assertTrue($this->interfaceReflection->implementsInterface(RichInterface::class));
    }

    public function testGetInterfaces(): void
    {
        $interfaces = $this->interfaceReflection->getInterfaces();
        $this->assertCount(2, $interfaces);
        $this->assertInstanceOf(InterfaceReflectionInterface::class, $interfaces[0]);
    }

//    public function testGetOwnInterfaceNames(): void
//    {
//        $this->assertSame([RichInterface::class], $this->reflectionClass->getOwnInterfaceNames());
//    }
//
//    public function testGetDirectImplementers(): void
//    {
//        $this->assertCount(1, $this->reflectionClassOfInterface->getDirectImplementers());
//    }
//
//    public function testGetIndirectImplementers(): void
//    {
//        $indirectImplementers = $this->reflectionClassOfInterface->getIndirectImplementers();
//        $this->assertSame([], $indirectImplementers);
//    }
}

<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.5
 *
 * @copyright 2010-2015 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\Php;
use phpDocumentor\Reflection\Php\Factory\DummyFactoryStrategy;

/**
 * Test case for ProjectFactoryStrategyContainer
 *
 * @coversDefaultClass phpDocumentor\Reflection\Php\ProjectFactoryStrategyContainer
 */
class ProjectFactoryStrategyContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::addStrategy
     */
    public function testStrategiesAreChecked()
    {
        new ProjectFactoryStrategyContainer(array(new DummyFactoryStrategy()));
    }

    /**
     * @covers ::findMatching
     * @covers ::<private>
     */
    public function testFindMatching()
    {
        $strategy = new DummyFactoryStrategy();
        $container = new ProjectFactoryStrategyContainer(array($strategy));
        $actual = $container->findMatching(array('aa'));

        $this->assertSame($strategy, $actual);
    }

    /**
     * @covers ::findMatching
     * @covers ::<private>
     *
     * @expectedException \OutOfBoundsException
     */
    public function testCreateThrowsExceptionWhenStrategyNotFound()
    {
        $container = new ProjectFactoryStrategyContainer(array());
        $container->findMatching(array('aa'));
    }
}

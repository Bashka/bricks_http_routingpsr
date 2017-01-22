<?php
namespace BricksTest\Http\RoutingPsr\Rule\Logic;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\Logic\OrRule;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class OrRuleTest extends \PHPUnit_Framework_TestCase{
  public function testMatch(){
    $rule = new OrRule([
      new PathLiteralRule('/foo/baz', ['foo' => 'baz']),
      new PathLiteralRule('/foo/bar', ['foo' => 'bar']),
    ]);

    $match = $rule->match(new Request('http://site.com/foo/bar'));
    $this->assertEquals(['foo' => 'bar'], $match->getParams());
    $match = $rule->match(new Request('http://site.com/foo/baz'));
    $this->assertEquals(['foo' => 'baz'], $match->getParams());
    $match = $rule->match(new Request('http://site.com/foo'));
    $this->assertNull($match);
  }
}

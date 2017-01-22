<?php
namespace BricksTest\Http\RoutingPsr\Rule\Logic;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\Logic\NotRule;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class NotRuleTest extends PHPUnit_Framework_TestCase{
  public function testMatch(){
    $rule = new NotRule(new PathLiteralRule('/foo/bar', ['foo' => 'bar']), ['test' => 'val']);

    $match = $rule->match(new Request('http://site.com/foo/bar'));
    $this->assertNull($match);
    $match = $rule->match(new Request('http://site.com/foo'));
    $this->assertEquals(['test' => 'val'], $match->getParams());
  }
}

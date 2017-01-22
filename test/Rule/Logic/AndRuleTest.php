<?php
namespace BricksTest\Http\RoutingPsr\Rule\Logic;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\Logic\AndRule;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;
use Bricks\Http\RoutingPsr\Rule\MethodRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class AndRuleTest extends \PHPUnit_Framework_TestCase{
  public function testMatch(){
    $rule = new AndRule([
      new MethodRule('GET'),
      new PathLiteralRule('/foo/bar', ['foo' => 'bar']),
    ]);

    $match = $rule->match(new Request('http://site.com/foo/bar', 'GET'));
    $this->assertEquals(['foo' => 'bar'], $match->getParams());
    $match = $rule->match(new Request('http://site.com/foo', 'GET'));
    $this->assertNull($match);
    $match = $rule->match(new Request('http://site.com/foo/bar', 'POST'));
    $this->assertNull($match);
  }
}

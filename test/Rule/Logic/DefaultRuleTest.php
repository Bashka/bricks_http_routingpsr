<?php
namespace BricksTest\Http\RoutingPsr\Rule\Logic;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\Logic\DefaultRule;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class DefaultRuleTest extends \PHPUnit_Framework_TestCase{
  public function testMatch(){
    $rule = new DefaultRule(
      new PathLiteralRule('/foo/bar', ['foo' => 'bar']),
      ['foo' => 'baz']
    );

    $match = $rule->match(new Request('http://site.com/foo/bar'));
    $this->assertEquals(['foo' => 'bar'], $match->getParams());
    $match = $rule->match(new Request('http://site.com/foo'));
    $this->assertEquals(['foo' => 'baz'], $match->getParams());
  }
}

<?php
namespace BricksTest\Http\RoutingPsr\Rule;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\MethodRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class MethodRuleTest extends PHPUnit_Framework_TestCase{
  public function testMatch(){
    $request = new Request('http://site.com/foo/bar', 'GET');
    $rule = new MethodRule('GET', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertEquals(['foo' => 'bar'], $match->getParams());
  }

  public function testMatch_shouldReturnNullIfRequestNotValid(){
    $request = new Request('http://site.com/foo/bar', 'POST');
    $rule = new MethodRule('GET', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertNull($match);
  }
}

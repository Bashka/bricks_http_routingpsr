<?php
namespace BricksTest\Http\RoutingPsr\Rule;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\SchemeRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class SchemeRuleTest extends PHPUnit_Framework_TestCase{
  public function testMatch(){
    $request = new Request('http://site.com/foo/bar');
    $rule = new SchemeRule('http', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertEquals(['foo' => 'bar'], $match->getParams());
  }

  public function testMatch_shouldReturnNullIfRequestNotValid(){
    $request = new Request('http://site.com/foo/bar');
    $rule = new SchemeRule('https', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertNull($match);
  }
}

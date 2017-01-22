<?php
namespace BricksTest\Http\RoutingPsr\Rule;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class PathLiteralRuleTest extends PHPUnit_Framework_TestCase{
  public function testMatch(){
    $request = new Request('http://site.com/foo/bar');
    $rule = new PathLiteralRule('/foo/bar', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertEquals(['foo' => 'bar'], $match->getParams());
  }

  public function testMatch_shouldReturnNullIfRequestNotValid(){
    $request = new Request('http://site.com/foo/bar');
    $rule = new PathLiteralRule('/foo', ['foo' => 'bar']);

    $match = $rule->match($request);

    $this->assertNull($match);
  }
}

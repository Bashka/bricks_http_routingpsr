<?php
namespace BricksTest\Http\RoutingPsr\Rule;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\Rule\PathRegexRule;
use Zend\Diactoros\Request;

/**
 * @author Artur Sh. Mamedbekov
 */
class PathRegexRuleTest extends PHPUnit_Framework_TestCase{
  public function testMatch(){
    $rule = new PathRegexRule('~^/(?<controller>\w+)(\/(?<action>\w+))?~', [
      'action' => 'index',
    ]);

    $match = $rule->match(new Request('http://site.com/foo/bar'));
    $this->assertEquals(['controller' => 'foo', 'action' => 'bar'], $match->getParams());

    $match = $rule->match(new Request('http://site.com/foo'));
    $this->assertEquals(['controller' => 'foo', 'action' => 'index'], $match->getParams());
  }

  public function testMatch_shouldReturnNullIfRequestNotValid(){
    $rule = new PathRegexRule('~^/(?<controller>\w+)(\/(?<action>\w+))?~', [
      'action' => 'index',
    ]);
  
    $match = $rule->match(new Request('http://site.com/'));
  
    $this->assertNull($match);
  }
}

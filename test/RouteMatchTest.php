<?php
namespace BricksTest\Http\RoutingPsr;

use PHPUnit_Framework_TestCase;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * @author Artur Sh. Mamedbekov
 */
class RouteMatchTest extends PHPUnit_Framework_TestCase{
  public function testGetParams(){
    $params = ['foo' => 'bar'];
    $match = new RouteMatch($params);

    $this->assertEquals($params, $match->getParams());
  }

  public function testGetParam(){
    $match = new RouteMatch(['foo' => 'bar']);

    $this->assertEquals('bar', $match->getParam('foo'));
  }

  public function testMerge(){
    $matchA = new RouteMatch(['foo' => 'bar']);
    $matchB = new RouteMatch(['test' => 'val']);
    
    $this->assertEquals(['foo' => 'bar', 'test' => 'val'], $matchA->merge($matchB)->getParams());
  }

  public function testMerge_shouldAddParams(){
    $matchA = new RouteMatch(['foo' => 'bar']);
    $matchB = new RouteMatch(['foo' => 'baz']);

    $this->assertEquals(['foo' => ['bar', 'baz']], $matchA->merge($matchB)->getParams());
  }
}

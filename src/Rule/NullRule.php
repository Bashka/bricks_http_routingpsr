<?php
namespace Bricks\Http\RoutingPsr\Rule;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;

/**
 * Правило всегда возвращает null.
 *
 * @author Artur Sh. Mamedbekov
 */
class NullRule implements RouteRuleInterface{
  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    return null;
  }
}

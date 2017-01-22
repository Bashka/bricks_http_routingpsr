<?php
namespace Bricks\Http\RoutingPsr\Rule\Logic;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Логическое НЕ.
 *
 * @author Artur Sh. Mamedbekov
 */
class NotRule implements RouteRuleInterface{
  /**
   * @var RouteRuleInterface Отрицаемое правило.
   */
  protected $rule;

  /**
   * @var array Значения параметров результата запроса при отрицании.
   */
  protected $defaults;
  
  /**
   * @param RouteRuleInterface $rule Отрицаемое правило.
   * @param array $defaults [optional] Значения параметров результата запроса 
   * при отрицании.
   */
  public function __construct(RouteRuleInterface $rule, array $defaults = []){
    $this->rule = $rule;
    $this->defaults = $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    $routeMatch = $this->rule->match($request);
    if(!is_null($routeMatch)){
      return null;
    }

    return new RouteMatch($this->defaults);
  }
}

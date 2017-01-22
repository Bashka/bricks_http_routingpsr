<?php
namespace Bricks\Http\RoutingPsr\Rule\Logic;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Защитное условие.
 *
 * @author Artur Sh. Mamedbekov
 */
class DefaultRule implements RouteRuleInterface{
  /**
   * @var RouteRuleInterface Защищаемое правило.
   */
  protected $rule;

  /**
   * @var array Значения параметров результата запроса для защиты.
   */
  protected $defaults;
  
  /**
   * @param RouteRuleInterface $rule Отрицаемое правило.
   * @param array $defaults [optional] Значения параметров результата запроса 
   * для защиты.
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
    if(is_null($routeMatch)){
      return new RouteMatch($this->defaults);
    }

    return $routeMatch;
  }
}

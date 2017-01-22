<?php
namespace Bricks\Http\RoutingPsr\Rule\Logic;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Логическое ИЛИ.
 *
 * @author Artur Sh. Mamedbekov
 */
class OrRule implements RouteRuleInterface{
  /**
   * @var RouteRuleInterface[] Входящие в условие правила.
   */
  protected $rules;
  
  /**
   * @param RouteRuleInterface[] $rules Входящие в условие правила.
   */
  public function __construct(array $rules){
    $this->rules = $rules;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    foreach($this->rules as $rule){
      $routeMatch = $rule->match($request);
      if(!is_null($routeMatch)){
        return $routeMatch;
      }
    }

    return null;
  }
}

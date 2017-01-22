<?php
namespace Bricks\Http\RoutingPsr\Rule\Logic;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Логическое И.
 *
 * @author Artur Sh. Mamedbekov
 */
class AndRule implements RouteRuleInterface{
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
    $resultMatch = new RouteMatch;
    foreach($this->rules as $rule){
      $routeMatch = $rule->match($request);
      if(is_null($routeMatch)){
        return null;
      }
      $resultMatch = $resultMatch->merge($routeMatch);
    }

    return $resultMatch;
  }
}

<?php
namespace Bricks\Http\RoutingPsr\Rule;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Условие точного соответствия метода запроса.
 *
 * @author Artur Sh. Mamedbekov
 */
class MethodRule implements RouteRuleInterface{
  /**
   * @var string Ожидаемый метод.
   */
  protected $assertMethod;

  /**
   * @var array Значения параметров результата запроса по умолчанию.
   */
  protected $defaults;

  /**
   * @param string $assertMethod Ожидаемый метод.
   * @param array $defaults [optional] Значения параметров результата запроса по 
   * умолчанию.
   */
  public function __construct($assertMethod, array $defaults = []){
    $this->assertMethod = $assertMethod;
    $this->defaults = $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    if($this->assertMethod != $request->getMethod()){
      return null;
    }

    return new RouteMatch($this->defaults);
  }
}

<?php
namespace Bricks\Http\RoutingPsr\Rule;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Условие точного соответствия схемы запроса.
 *
 * @author Artur Sh. Mamedbekov
 */
class SchemeRule implements RouteRuleInterface{
  /**
   * @var string Ожидаемая схема.
   */
  protected $assertScheme;

  /**
   * @var array Значения параметров результата запроса по умолчанию.
   */
  protected $defaults;

  /**
   * @param string $assertScheme Ожидаемая схема.
   * @param array $defaults [optional] Значения параметров результата запроса по 
   * умолчанию.
   */
  public function __construct($assertScheme, array $defaults = []){
    $this->assertScheme = $assertScheme;
    $this->defaults = $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    if($this->assertScheme != $request->getUri()->getScheme()){
      return null;
    }

    return new RouteMatch($this->defaults);
  }
}

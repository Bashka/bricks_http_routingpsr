<?php
namespace Bricks\Http\RoutingPsr\Rule;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Условие точного соответствия пути запроса.
 *
 * @author Artur Sh. Mamedbekov
 */
class PathLiteralRule implements RouteRuleInterface{
  /**
   * @var string Ожидаемый путь.
   */
  protected $assertPath;

  /**
   * @var array Значения параметров результата запроса по умолчанию.
   */
  protected $defaults;

  /**
   * @param string $assertPath Ожидаемый путь запроса.
   * @param array $defaults [optional] Значения параметров результата запроса по 
   * умолчанию.
   */
  public function __construct($assertPath, array $defaults = []){
    $this->assertPath = $assertPath;
    $this->defaults = $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    if($this->assertPath != $request->getUri()->getPath()){
      return null;
    }

    return new RouteMatch($this->defaults);
  }
}

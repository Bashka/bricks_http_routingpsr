<?php
namespace Bricks\Http\RoutingPsr\Rule;

use Psr\Http\Message\RequestInterface;
use Bricks\Http\RoutingPsr\RouteRuleInterface;
use Bricks\Http\RoutingPsr\RouteMatch;

/**
 * Условие обработки пути запроса регулярным выражением.
 *
 * @author Artur Sh. Mamedbekov
 */
class PathRegexRule implements RouteRuleInterface{
  /**
   * @var string Используемое для проверки регулярное выражение.
   */
  protected $regex;

  /**
   * @var array Значения параметров результата запроса по умолчанию.
   */
  protected $defaults;

  /**
   * @param string $regex Используемое для проверки регулярное выражение.
   * @param array $defaults [optional] Значения параметров результата запроса по 
   * умолчанию.
   */
  public function __construct($regex, array $defaults = []){
    $this->regex = $regex;
    $this->defaults = $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function match(RequestInterface $request){
    $match = [];
    if(preg_match($this->regex, $request->getUri()->getPath(), $match) === 0){
      return null;
    }

    array_shift($match);

    $match = array_filter($match, function($value, $key){
      return is_string($key);
    }, ARRAY_FILTER_USE_BOTH);

    return new RouteMatch(array_merge($this->defaults, $match));
  }
}

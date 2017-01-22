<?php
namespace Bricks\Http\RoutingPsr;

use Psr\Http\Message\RequestInterface;

/**
 * Правило роутинга.
 *
 * @author Artur Sh. Mamedbekov
 */
interface RouteRuleInterface{
  /**
   * @param RequestInterface $request Обрабатываемый запрос.
   *
   * @return RouteMatchInterface|null Результат роутинга запроса или null - если 
   * запрос не соответствует правилу.
   */
  public function match(RequestInterface $request);
}

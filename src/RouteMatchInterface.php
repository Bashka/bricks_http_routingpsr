<?php
namespace Bricks\Http\RoutingPsr;

/**
 * Результат роутинга запроса.
 *
 * @author Artur Sh. Mamedbekov
 */
interface RouteMatchInterface{
  /**
   * @return array Значения параметров обработки запроса.
   */
  public function getParams();

  /**
   * @param string $name Имя целевого параметра.
   * @param mixed $default [optional] Значение, возвращаемое по умолчанию.
   *
   * @return mixed Значение целевого параметра.
   */
  public function getParam($name, $default = null);
}

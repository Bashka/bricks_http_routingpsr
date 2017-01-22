<?php
namespace Bricks\Http\RoutingPsr;

/**
 * @author Artur Sh. Mamedbekov
 */
class RouteMatch implements RouteMatchInterface{
  /**
   * @var array Значения параметров обработки запроса.
   */
  protected $params;

  /**
   * @param array $params [optional] Значения параметров обработки запроса.
   */
  public function __construct(array $params = []){
    $this->params = $params;
  }

  /**
   * {@inheritdoc}
   */
  public function getParams(){
    return $this->params;
  }

  /**
   * {@inheritdoc}
   */
  public function getParam($name, $default = null){
    if(!isset($this->params[$name])){
      return $default;
    }

    return $this->params[$name];
  }

  /**
   * Объединяет значения параметров обработки запроса.
   *
   * @param RouteMatchInterface $routeMatch Добавляемые результаты обработки 
   * запроса.
   *
   * @return RouteMatchInterface
   */
  public function merge(RouteMatchInterface $routeMatch){
    return new self(array_merge($this->getParams(), $routeMatch->getParams()));
  }
}

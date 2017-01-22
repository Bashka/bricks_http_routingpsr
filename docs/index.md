# Правило обработки запроса
Интерфейс `Bricks\Http\RoutingPsr\RouteRuleInterface` описывает правило обработки запроса. Конкретные правила используют метод `match`, принимающий экземпляр запроса и возвращающие результат обработки или `null`, если запрос не валиден данному правилу.

```php
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;

$request = new Request('http://site.com/foo/bar');

$rule = new PathLiteralRule('/foo/bar', ['foo' => 'bar']);
$match = $rule->match($request);

var_dump($match->getParams()); // ['foo' => 'bar'] - запрос соответствует правилу обработки
```

# Результат обработки запроса
Интерфейс `Bricks\Http\RoutingPsr\RouteMatchInterface` описывает результаты обработки запроса. Класс `Bricks\Http\RoutingPsr\RouteMatch` является его реализацией, хранящей результаты обработки в виде простого массива.

```php
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;

$request = new Request('http://site.com/foo/bar');

$rule = new PathLiteralRule('/foo/bar', [
    'foo' => 'bar' // Результаты обработки
]);
$match = $rule->match($request); // Результатом обработки является класс RouteMatch
```

```php
use Bricks\Http\RoutingPsr\Rule\PathRegexRule;

$rule = new PathRegexRule('~^/(?<controller>\w+)(\/(?<action>\w+))?~', [
  'action' => 'index',
]);

$match = $rule->match(new Request('http://site.com/foo/bar'));
var_dump($match->getParams()); // ['controller' => 'foo', 'action' => 'bar']

$match = $rule->match(new Request('http://site.com/foo'));
var_dump($match->getParams()); // ['controller' => 'foo', 'action' => 'index']
```

# Сложные правила обработки
Классы уровня `Bricks\Http\RoutingPsr\Rule\Logic` позволяют объединить несколько правил обработки с помощью логических условий.

```php
use Bricks\Http\RoutingPsr\Rule\Logic\AndRule;
use Bricks\Http\RoutingPsr\Rule\MethodRule;
use Bricks\Http\RoutingPsr\Rule\PathLiteralRule;

$request = new Request('http://site.com/foo/bar', 'POST');

$rule = new AndRule([
  new MethodRule('POST'),
  new PathLiteralRule('/foo/bar', ['foo' => 'bar']),
]);

$match = $rule->match($request);

var_dump($match->getParams()); // ['foo' => 'bar'] - запрос соответствует каждому правилу
```

Доступные классы:

  * `AndRule` - логическое И. Запрос должен удовлетворять каждому правилу. Результат будет содержать объединение всех параметров
  * `OrRule` - логическое ИЛИ. Запрос может удовлетворять любому из правил. Результатом будет параметр первого удачного правила
  * `NotRule` - логическое НЕ. Запрос будет удовлетворать правилу, только если он ему не удовлетворяет.
  * `DefaultRule` - защищающее условие. Если запрос не удовлетворяет правилу, будет предоставлены параметры по умолчанию.

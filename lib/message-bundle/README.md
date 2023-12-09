
# mazarini/message-bundle
Display alerts on webpage for symfony using [alert](https://getbootstrap.com/docs/5.3/components/alerts/) from [bootstrap](https://getbootstrap.com/).
## Installation
```console
foo@bar:~$ composer require mazarini/message-bundle
```
## Add alerts with twig
In template/base.html.twig :
```twig
{% include('@MazariniMessage/_messages.html.twig') %}
```
## Display alerts in create order
In each controller :
```php
<?php
...
use Mazarini\MessageBundle\Controller\MessageControllerTrait;
...
class HomeController extends AbstractController
{
    use MessageControllerTrait;
...
}
```
## Default configuration
```console
foo@bar:~$ symfony console debug:config MazariniMessageBundle

Current configuration for "MazariniMessageBundle"
=================================================

mazarini_message:
    default: alert-danger
    types:
        primary: alert-primary
        secondary: alert-secondary
        success: alert-success
        danger: alert-danger
        error: alert-danger
        warning: alert-warning
        info: alert-info
        light: alert-light
        dark: alert-dark

foo@bar:~$
```
"types" is use to translate type of messages to class of alerts. By default, bootstrap classes are defines but other can be use.

# Eskirex Session Component
Hello.
This is Session component.

## Examples
```php
<?php

    require __DIR__ . '/vendor/autoload.php';
    
    use Eskirex\Component\Session\Exceptions\SessionRuntimeException;
    use Eskirex\Component\Session\Session;
    
    
    $session = new Session();
    
    try {
        $session->start();
    } catch (SessionRuntimeException $e) {
    
    }
    
    $session->set('foo.bar', 'baz');
    
    echo $session->get('foo.bar');
    // baz
    
    print_r($session->get('foo'));
    // Array
    // (
    //     [bar] => baz
    // )
```
## License
MIT
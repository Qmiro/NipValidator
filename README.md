# NipValidator
Walidacja numeru NIP używanego na terytorium Polski

Walidator służący do weryfikacji numeru NIP obowiązujący na terenie Polski. Jest on rozszerzeniem dostępnych walidatorów dla <b>Laminas Framework</b> (dawniej <b>Zend Frameworok</b>).

Dozwolone są wyłacznie cyfry oraz znak myślnika

Użycie walidatora dla krótkiego mumeru

```php

<?php

declare(strict_types = 1);
use Application\Validator\NipValidator;

include __DIR__ . '/vendor/autoload.php';

/**
 * NIP mozemy podac w wersji krótkeij 1445452059 lub długiej 144-545-20-59
 */
$numerNip = '144-545-20-59';

$validator = new NipValidator();

if ($validator->isValid($numerNip) !== false) {
    echo 'Podany numer NIP jest prawidłowy';
} else {
    echo 'Podany numer NIP jest nie prawidłowy';
    $messages = $validator->getMessages();
    foreach ($messages as $key => $value) {
        echo $key . ' => ' . $value . '<br/>';
    }
}
```

Wartości dla kluczy tłumaczeń walidatora
 - nipNotScalar - Numer NIP musi być wartością skalarną
 - nipLenght - Nieprawidłowa długość dla numeru NIP
 - nipCharset - W numerze NIP dozwolone są wyłącznie cyfry oraz znak myślnika
 - nipCorect - Podany Numer NIP jest nieprawidłowy

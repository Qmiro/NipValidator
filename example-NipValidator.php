<?php

/**
 * @filesource example-NipValidator.php
 * 
 * Message templates
 * nipNotScalar - Numer NIP musi być wartością skalarną
 * nipLenght - Nieprawidłowa długość dla numeru NIP
 * nipCharset - W numerze NIP dozwolone są wyłącznie cyfry oraz znak myślnika
 * nipCorect - Podany Numer NIP jest nieprawidłowy
 */
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
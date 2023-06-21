<?php

/**
 * @name NipValidator
 * @package Validator
 * @version 1.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2023 (https://www.appsonline.eu)
 * @link https://www.appsonline.eu
 */
declare(strict_types = 1);
namespace Application\Validator;

use Laminas\Validator\AbstractValidator;

class NipValidator extends AbstractValidator
{

    /**
     *
     * @var string
     */
    private const NIP_NOT_SCALAR = 'nipNotScalar';
    
    /**
     *
     * @var string
     */
    private const NIP_LENGHT = 'nipLenght';

    /**
     *
     * @var string
     */
    private const NIP_CHARSET = 'nipCharset';

    /**
     *
     * @var string
     */
    private const NIP_CORECT = 'nipCorect';

    /**
     *
     * @var array
     */
    protected $messageTemplates = [
        self::NIP_NOT_SCALAR => 'The NIP number must be a scalar value',
        self::NIP_LENGHT => 'Incorrect length for NIP number',
        self::NIP_CHARSET => 'Only numbers and the dash sign are allowed in the NIP number',
        self::NIP_CORECT => 'The provided tax identification number is incorrect '
    ];

    /**
     *
     * @name isValid
     * @access public
     * @param string $value
     * @see \Laminas\Validator\ValidatorInterface::isValid()
     */
    public function isValid($value): bool
    {
        if (! is_scalar($value)) {
            $this->error(self::NIP_NOT_SCALAR);
            return false;
        }
        
        $value = (string) trim(str_replace([
            ' ',
            '-'
        ], '', $value));

        if (strlen($value) < 10) {
            $this->error(self::NIP_LENGHT);
            return false;
        }

        if (! preg_match('/^[0-9]{10}$/i', $value)) {
            $this->error(self::NIP_CHARSET);
            return false;
        } else {
            $tab = [
                6,
                5,
                7,
                2,
                3,
                4,
                5,
                6,
                7
            ];
            $index = [
                0,
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9
            ];

            $sum = 0;
            for ($i = 0; $i < 9; $i ++) {
                $sum += substr($value, $index[$i], 1) * $tab[$i];
            }

            $sum = $sum % 11;
            if ($sum != substr($value, $index[9], 1)) {
                $this->error(self::NIP_CORECT);
                return false;
            }
        }
        
        return true;
    }
}

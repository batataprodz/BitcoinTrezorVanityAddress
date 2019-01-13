<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 02:39
 */

namespace Boruta\BitcoinVanity\ValueObject;


use Boruta\BitcoinVanity\Constant\DerivedPathConstant;
use Boruta\BitcoinVanity\Exception\ValueObjectException;
use ReflectionClass;
use ReflectionException;

/**
 * Class DerivedPath
 * @package Boruta\BitcoinVanity\ValueObject
 */
class DerivedPath implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * DerivedPath constructor.
     * @param $value
     * @throws ValueObjectException
     */
    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new ValueObjectException('Derived path is incorrect!');
        }
        $this->value = (string)$value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function validate($value): bool
    {
        if (!\is_string($value)) {
            return false;
        }

        $explodedValue = explode('/', $value);

        if (empty($explodedValue) || !\is_array($explodedValue)) {
            return false;
        }

        $derivedPathPosition = (string)$explodedValue[\count($explodedValue) - 1];
        if (!is_numeric($derivedPathPosition) || (string)(int)$derivedPathPosition !== (string)$derivedPathPosition) {
            return false;
        }

        $valuePrefix = substr($value, 0, -\strlen($derivedPathPosition));

        try {
            $allowedDerivedPath = (new ReflectionClass(DerivedPathConstant::class))->getConstants();
        } catch (ReflectionException $exception) {
            return false;
        }

        return \in_array($valuePrefix, $allowedDerivedPath, true);
    }
}
<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Collection;


use Boruta\BitcoinVanity\Exception\InvalidCollectionElementException;
use Cartalyst\Collections\Collection;

/**
 * Class AbstractCollection
 * @package Boruta\BitcoinVanity\Collection
 */
abstract class AbstractCollection extends Collection
{
    protected const ELEMENT_CLASS = null;

    /**
     * @param mixed $value
     * @throws InvalidCollectionElementException
     */
    public function push($value): void
    {
        $this->verifyElement($value);
        parent::push($value);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @throws InvalidCollectionElementException
     */
    public function put($key, $value): void
    {
        $this->verifyElement($value);
        parent::put($key, $value);
    }

    /**
     * @param mixed $value
     * @throws InvalidCollectionElementException
     */
    protected function verifyElement($value): void
    {
        if (self::ELEMENT_CLASS === null) {
            return;
        }

        if (!is_object($value) || get_class($value) !== self::ELEMENT_CLASS) {
            throw new InvalidCollectionElementException('Invalid type of given value!');
        }
    }
}
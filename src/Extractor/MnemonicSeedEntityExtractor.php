<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 09.12.18
 * Time: 15:02
 */

namespace Boruta\BitcoinVanity\Extractor;


use Boruta\BitcoinVanity\Entity\MnemonicSeedEntity;
use Boruta\BitcoinVanity\Mapper\MnemonicSeedEntityMapper;
use Boruta\BitcoinVanity\ValueObject\ValueObjectInterface;

/**
 * Class MnemonicSeedEntityExtractor
 * @package Boruta\BitcoinVanity\Extractor
 */
class MnemonicSeedEntityExtractor
{
    /**
     * @param MnemonicSeedEntity $entity
     * @return array
     */
    public function extract(MnemonicSeedEntity $entity): array
    {
        $data = [];

        if (($field = $entity->getId()) instanceof ValueObjectInterface) {
            $data[MnemonicSeedEntityMapper::FIELD_ID] = $field->value();
        }

        if (($field = $entity->getEncryptedPhrase()) instanceof ValueObjectInterface) {
            $data[MnemonicSeedEntityMapper::FIELD_ENCRYPTED_PHRASE] = $field->value();
        }

        if (($field = $entity->getEntropySize()) instanceof ValueObjectInterface) {
            $data[MnemonicSeedEntityMapper::FIELD_ENTROPY_SIZE] = $field->value();
        }

        return $data;
    }
}
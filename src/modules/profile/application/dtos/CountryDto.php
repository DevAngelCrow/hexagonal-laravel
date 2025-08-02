<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\country\Country;

class CountryDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $abbreviation,
        public readonly string $code,
        public readonly bool $state,
        public readonly ?int $id = null,
    ) {}
    public static function fromEntity(Country $country){
        return new self(
            $country->getName()->value(),
            $country->getAbbreviation()->value(),
            $country->getCode()->value(),
            $country->getState()->value(),
            $country->getId()->value() ?: null,
        );
    }
}

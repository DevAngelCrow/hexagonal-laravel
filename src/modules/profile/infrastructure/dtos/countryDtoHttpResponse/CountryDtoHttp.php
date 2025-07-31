<?php

namespace Src\modules\profile\infrastructure\dtos\countryDtoHttpResponse;

use Src\modules\profile\domain\entities\country\Country;

class CountryDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $abbreviation,
        public readonly string $code,
        public readonly bool $state,
    ) {}
    public static function fromEntity(Country $country){
        return new self(
            $country->getId()->value(),
            $country->getName()->value(),
            $country->getAbbreviation()->value(),
            $country->getCode()->value(),
            $country->getState()->value()
        );
    }
}

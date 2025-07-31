<?php

namespace Src\modules\profile\domain\entities\country;

use Src\modules\profile\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\profile\domain\value_objects\country_value_object\CountryCode;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
use Src\modules\profile\domain\value_objects\country_value_object\CountryName;
use Src\modules\profile\domain\value_objects\country_value_object\CountryState;

class Country
{
    private readonly CountryName $name;
    private readonly CountryAbbreviation $abbreviation;
    private readonly CountryCode $code;
    private readonly CountryState $state;
    private readonly ?CountryId $id;

    public function __construct(
        CountryName $name,
        CountryAbbreviation $abbreviation,
        CountryCode $code,
        CountryState $state,
        ?CountryId $id = null
    ) {
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->code = $code;
        $this->state = $state;
        $this->id = $id;
    }

    public function getName(): CountryName
    {
        return $this->name;
    }

    public function getAbbreviation(): CountryAbbreviation
    {
        return $this->abbreviation;
    }

    public function getCode(): CountryCode
    {
        return $this->code;
    }

    public function getState(): CountryState
    {
        return $this->state;
    }

    public function getId(): ?CountryId
    {
        return $this->id;
    }
}

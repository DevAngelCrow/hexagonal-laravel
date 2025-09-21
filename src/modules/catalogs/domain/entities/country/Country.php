<?php

namespace Src\modules\catalogs\domain\entities\country;

use Src\modules\catalogs\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryCode;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryId;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryName;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryState;

class Country
{
    private readonly CountryName $name;
    private readonly CountryAbbreviation $abbreviation;
    private readonly CountryCode $code;
    private readonly CountryState $active;
    private readonly ?CountryId $id;

    public function __construct(
        CountryName $name,
        CountryAbbreviation $abbreviation,
        CountryCode $code,
        CountryState $active,
        ?CountryId $id = null
    ) {
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->code = $code;
        $this->active = $active;
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

    public function getActive(): CountryState
    {
        return $this->active;
    }

    public function getId(): ?CountryId
    {
        return $this->id;
    }
}

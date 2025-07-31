<?php

namespace Src\modules\profile\domain\entities\district;

use Src\modules\profile\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictId;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictName;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictState;

class District
{
    private readonly DistrictIdMunicipality $id_municipality;
    private readonly DistrictName $name;
    private readonly DistrictDescription $description;
    private readonly DistrictState $state;
    private readonly ?DistrictId $id;

    public function __construct(
        DistrictIdMunicipality $id_municipality,
        DistrictName $name,
        DistrictDescription $description,
        DistrictState $state,
        ?DistrictId $id = null
    ) {
        $this->id_municipality = $id_municipality;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->id = $id;
    }

    public function getIdMunicipality(): DistrictIdMunicipality
    {
        return $this->id_municipality;
    }

    public function getName(): DistrictName
    {
        return $this->name;
    }

    public function getDescription(): DistrictDescription
    {
        return $this->description;
    }

    public function getState(): DistrictState
    {
        return $this->state;
    }
    public function getId(): ?DistrictId
    {
        return $this->id;
    }
}

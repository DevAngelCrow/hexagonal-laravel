<?php
namespace Src\modules\catalogs\domain\aggregate\district;

use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\entities\municipality\Municipality;

class DistrictWithMunicipality {
    private Municipality $municipality;
    private District $district;

    public function __construct(Municipality $municipality, District $district)
    {
        $this->municipality = $municipality;
        $this->district = $district;
    }

    public function getMunicipality() : Municipality {
        return $this->municipality;
    }
    public function getDistrict() : District {
        return $this->district;
    }
}
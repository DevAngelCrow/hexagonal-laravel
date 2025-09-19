<?php
namespace Src\modules\profile\domain\aggregate\district;

use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\entities\municipality\Municipality;

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
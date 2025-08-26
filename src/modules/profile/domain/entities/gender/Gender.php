<?php

namespace Src\modules\profile\domain\entities\gender;

use Src\modules\profile\domain\value_objects\gender_value_object\GenderId;
use Src\modules\profile\domain\value_objects\gender_value_object\GenderName;

class Gender{
    private readonly ?GenderId $id;
    private readonly GenderName $name;
    public function __construct(
        GenderName $name,
        ?GenderId $id = null,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?GenderId
    {
        return $this->id;
    }

    public function getName(): GenderName
    {
        return $this->name;
    }   
}


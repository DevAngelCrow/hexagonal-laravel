<?php
namespace Src\modules\auth\domain\ports;

interface TokenGeneratorInterface {
    public function generate(mixed $modelUser) : string;
}
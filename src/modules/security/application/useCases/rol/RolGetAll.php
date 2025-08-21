<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;

class RolGetAll {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run(?int $page, ?int $per_page) : array{
        return $this->rolRepository->getAll($page, $per_page);
    }
}
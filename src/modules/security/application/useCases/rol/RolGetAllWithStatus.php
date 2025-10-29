<?php
namespace Src\modules\security\application\useCases\rol;

use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;

class RolGetAllWithStatus {
    private readonly RolRepositoryInterface $rolRepository;

    public function __construct(RolRepositoryInterface $rol_repository)
    {
        $this->rolRepository = $rol_repository;
    }

    public function run(?int $page, ?int $per_page, ?string $filter_name = null) : array{
        return $this->rolRepository->getAllWithStatus($page, $per_page, $filter_name);
    }
}
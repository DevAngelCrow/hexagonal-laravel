<?php
namespace Src\modules\security\application\dtos;

class RouteForUserDto {
    public function __construct(
        public readonly bool $active,
        public readonly array $children,
        public readonly string $description,
        public readonly string $icon,
        public readonly string $name,
        public readonly int $order,
        public readonly mixed $parent,
        public readonly bool $required_auth,
        public readonly bool $show,
        public readonly string $title,
        public readonly string $uri,
        public readonly ?int $id_parent = null,
        public readonly ?int $id = null,
    )
    {}
}
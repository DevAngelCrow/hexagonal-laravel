<?php
namespace Src\shared\infrastructure\generalDtos;

class PaginatedResponseDto {
    public function __construct(
        public readonly mixed $items,
        public readonly mixed $pagination
    )
    {
        
    }

    public static function fromPaginatedResponse(mixed $data,mixed $pagination){
        return new self(
            $data,
            $pagination
        );
    }
}
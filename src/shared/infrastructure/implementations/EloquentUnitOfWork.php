<?php

namespace Src\shared\infrastructure\implementations;

use Illuminate\Support\Facades\DB;
use Src\shared\domain\repositories\UnitOfWorkTransactionDbInterface;

class EloquentUnitOfWork implements UnitOfWorkTransactionDbInterface{
    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }
    public function commit(): void
    {
        DB::commit();
    }
    public function rollback(): void
    {
        DB::rollBack();
    }
    public function transactional(callable $callback)
    {
        return DB::transaction($callback);
    }
}
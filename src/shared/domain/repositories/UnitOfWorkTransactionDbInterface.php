<?php
namespace Src\shared\domain\repositories;

interface UnitOfWorkTransactionDbInterface{
    public function beginTransaction() : void;
    public function commit() : void;
    public function rollback() : void;
    public function transactional(callable $callback);
}
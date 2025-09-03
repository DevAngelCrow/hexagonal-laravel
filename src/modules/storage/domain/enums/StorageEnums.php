<?php
namespace Src\modules\storage\domain\enums;

enum StorageEnums: string {
    case LOCAL = 'Local';
    case GOOGLE = "Goolgle";
    case AWS = "Amazon Web Service";
}
<?php

declare(strict_types=1);

namespace Yiisoft\Db\Schema\Column;

use Yiisoft\Db\Expression\ExpressionInterface;
use Yiisoft\Db\Constant\PhpType;
use Yiisoft\Db\Schema\SchemaInterface;

use function is_int;

class IntegerColumnSchema extends AbstractColumnSchema
{
    public function __construct(
        string $type = SchemaInterface::TYPE_INTEGER,
    ) {
        parent::__construct($type);
    }

    public function dbTypecast(mixed $value): int|ExpressionInterface|null
    {
        if (is_int($value)) {
            return $value;
        }

        return match ($value) {
            null, '' => null,
            default => $value instanceof ExpressionInterface ? $value : (int) $value,
        };
    }

    public function getPhpType(): string
    {
        return PhpType::INT;
    }

    public function phpTypecast(mixed $value): int|null
    {
        if ($value === null) {
            return null;
        }

        return (int) $value;
    }
}

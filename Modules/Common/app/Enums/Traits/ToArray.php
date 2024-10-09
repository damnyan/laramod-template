<?php

namespace Modules\Common\Enums\Traits;

trait ToArray
{
    /**
     * To array
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(
            array: self::cases(),
            column_key: 'value'
        );
    }
}

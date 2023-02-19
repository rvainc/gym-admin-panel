<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum UserRole: int
{
    case SuperAdmin = 1;
    case Admin = 2;

    /**
     * @return string
     */
    public function toString()
    {
        return Str::headline($this->name);
    }

    static public function getOptions()
    {
        $options = [];

        foreach (UserRole::cases() as $role) {
            $options[] = [
                'value' => $role->value,
                'label' => $role->name,
            ];
        }

        return $options;
    }
}

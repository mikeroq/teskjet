<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Admin()
 * @method static static User()
 */
final class UserType extends Enum implements LocalizedEnum
{
    public const ADMIN = 9;
    public const USER = 0;

    public function toArray()
    {
        return $this->description;
    }
}

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class JobStatus extends Enum
{
    const Draft =   0;
    const Pending =   1;
    const Active = 2;
    const Hidden = 3;
}

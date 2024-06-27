<?php 
namespace Devbrain\Ui\Enum;

use Devbrain\Ui\Trait\Enum\EnumTrait;

enum Size: string 
{
    use EnumTrait;

    case SMALL  = 'small';
    case NORMAL = 'normal';
    case LARGE  = 'large';
}
<?php 
namespace Devbrain\Ui\Enum;

use Devbrain\Ui\Trait\Enum\EnumTrait;

enum Effect: string 
{
    use EnumTrait;

    case NONE       = 'none';
    case CLOSE      = 'close';
    case FILL_IN    = 'fill-in';
    case FILL_DOWN  = 'fill-down';
    case FILL_RIGHT = 'fill-right';
    case FILL_UP    = 'fill-up';
    case FILL_LEFT  = 'fill-left';
    case PULSE      = 'pulse';
}
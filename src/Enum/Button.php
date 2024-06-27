<?php 
namespace Devbrain\Ui\Enum;

use Devbrain\Ui\Trait\Enum\EnumTrait;

enum Button: string 
{
    use EnumTrait;

    case BUTTON = 'button';
    case SUBMIT = 'submit';
    case RESET  = 'reset';
    case LINK   = 'link';
}
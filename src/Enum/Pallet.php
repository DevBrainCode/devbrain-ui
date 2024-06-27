<?php 
namespace Devbrain\Ui\Enum;

use Devbrain\Ui\Trait\Enum\EnumTrait;

enum Pallet: string 
{
    use EnumTrait;

    case SUCCESS   = 'success';
    case WARNING   = 'warning';
    case DANGER    = 'danger';
    case INFO      = 'info';
    case PRIMARY   = 'primary';
    case SECONDARY = 'secondary';
    case MUTED     = 'muted';
    case LIGHT     = 'light';
    case DARK      = 'dark';
}
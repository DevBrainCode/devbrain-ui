// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Offcanvas
// *
// ************************************************************************** //
// *
// *    <div rel="js-offcanvas">
// *
// ************************************************************************** //

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-offcanvas]';
const CLASS_NAME_ACTIVE = 'active';

export default class OffcanvasComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
    }

    _onInit() 
    {
    }

    show()
    {
    }

    hide()
    {
    }

    toggle()
    {
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new OffcanvasComponent(node));
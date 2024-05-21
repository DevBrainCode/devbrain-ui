// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Accordion
// *
// ************************************************************************** //
// *
// *    <div rel="js-accordion">
// *
// ************************************************************************** //

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-accordion]';
const CLASS_NAME_ACTIVE = 'active';

export default class AccordionComponent extends AbstractComponent
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

    to()
    {
    }

    toggle()
    {
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new AccordionComponent(node));
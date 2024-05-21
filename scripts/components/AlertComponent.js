// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Alert
// *
// ************************************************************************** //
// *
// *    <div rel="js-alert">
// *
// ************************************************************************** //

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-alert]';
const CLASS_NAME_ACTIVE = 'active';

export default class AlertComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
        this.element = node;
    }

    _onInit() 
    {
    }

    close()
    {
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new AlertComponent(node));
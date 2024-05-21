// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Cookieconsent
// *
// ************************************************************************** //
// *
// *    <div rel="js-cookieconsent">
// *
// ************************************************************************** //

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-cookieconsent]';
const CLASS_NAME_ACTIVE = 'active';

export default class CookieConsentComponent extends AbstractComponent
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

    update()
    {
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new CookieConsentComponent(node));
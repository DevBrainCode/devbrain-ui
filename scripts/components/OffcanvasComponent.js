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
import ButtonComponent from "./ButtonComponent";

// const SELECTOR          = '[rel=js-offcanvas]';
const TOGGLER_HANDLER   = '[rel=js-show-offcanvas]';
const SELECTOR          = '.offcanvas';
const CLASS_NAME_ACTIVE = 'active';

export default class OffcanvasComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
        this.element = node;
    }
    
    _onInit() 
    {
        let close_btn = this.node.querySelector('button[role=close]')
        this.on([close_btn, 'click'], {
            do: this._hide
        })
    }


    // _show()
    // {
    // }

    _hide(handler, event, element)
    {
        handler._element.classList.remove('show');
    }

    // _toggle()
    // {
    // }
}

document.querySelectorAll(SELECTOR).forEach(node => new OffcanvasComponent(node));


// OffCanvas Toggler button
// --
// 
// <button rel="js-show-offcanvas" data-target="offcanvas-right">Show Offcanvas Right</button>
//
document.querySelectorAll(TOGGLER_HANDLER).forEach(btn => {
    new ButtonComponent(btn).onClick = (event, element) => document.getElementById(element.dataset.target)?.classList.add('show')
});
    
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

const SELECTOR          = '.offcanvas';
const CLASS_NAME_ACTIVE = 'show';

export default class OffcanvasComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
        this.element = node;
    }

    show() {this.element.classList.add(CLASS_NAME_ACTIVE)}
    hide() {this.element.classList.remove(CLASS_NAME_ACTIVE)}
    toggle() {this.element.classList.toggle(CLASS_NAME_ACTIVE)}
    
    _onInit() 
    {
        // let close_btn = this.node.querySelector('button[role=close]')
        // this.on([close_btn, 'click'], {
        //     do: this._hide
        // })
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new OffcanvasComponent(node));


// OffCanvas Toggler button
// --
// 
// <button rel="js-show-offcanvas" data-target="offcanvas-right">Show Offcanvas Right</button>
//
document.querySelectorAll('[rel=js-show-offcanvas]').forEach(btn => new ButtonComponent(btn).onClick = (event, element) => new OffcanvasComponent(document.getElementById(element.dataset.target)).show());
document.querySelectorAll('[rel=js-hide-offcanvas]').forEach(btn => new ButtonComponent(btn).onClick = (event, element) => new OffcanvasComponent(document.getElementById(element.dataset.target)).hide());
document.querySelectorAll('[rel=js-toggle-offcanvas]').forEach(btn => new ButtonComponent(btn).onClick = (event, element) => new OffcanvasComponent(document.getElementById(element.dataset.target)).toggle());

// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Button
// *
// ************************************************************************** //
// *
// *    Instance
// *        new ButtonToTopComponent( document.querySelector('.my-custom-component') );
// *
// *    Events
// *        onDbclick(event, element)
// *        onBeforeDbclick(event, element)
// *        onAfterDbclick(event, element)
// *
// *    Methods
// *        isActive()
// *
// ************************************************************************** //
"use strict";

import AbstractComponent from "./AbstractComponent";

const SELECTOR                = '[rel=js-button-to-top]';
const CLASS_NAME_ACTIVE       = 'shwo';
const DEFAULT_TOP_POSITION    = 0;
const DEFAULT_TOGGLE_POSITION = 200;

export default class ButtonToTopComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
        this.element = node;

        window.onscroll = event => this._scroll(this.element);
        this._scroll(this.element);
    }

    _onInit() 
    {
        this.on('click', {
            do    : this._click,
            before: this._beforeClick,
            after : this._afterClick,
        });
    }

    _scroll(element)
    {
        const toggleAt = element.dataset.toggleAt ?? DEFAULT_TOGGLE_POSITION;

        document.body.scrollTop > toggleAt || document.documentElement.scrollTop > toggleAt
            ? element.classList.add('show') 
            : element.classList.remove('show')
        ;
    }

    _toggle()
    {
        this.node.setAttribute('aria-pressed', this.node.classList.toggle(CLASS_NAME_ACTIVE))
    }

    
    _click(handler, event, element)
    {
        const topAt = element.dataset.topAt ?? DEFAULT_TOP_POSITION;

        document.body.scrollTop = topAt;
        document.documentElement.scrollTop = topAt;

        if (typeof handler.onClick === 'function')
        {
            handler.onClick(event, element); 
            return;
        }
    }
    _beforeClick(handler, event, element)
    {
        if (typeof handler.onBeforeClick === 'function')
        {
            handler.onBeforeClick(event, element); 
            return;
        }
    }
    _afterClick(handler, event, element)
    {
        if (typeof handler.onAfterClick === 'function')
        {
            handler.onAfterClick(event, element); 
            return;
        }
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new ButtonToTopComponent(node));
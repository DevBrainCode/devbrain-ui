// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Button
// *
// ************************************************************************** //
// *
// *    Instance
// *        new ButtonComponent( document.querySelector('.my-custom-component') );
// *
// *    Events
// *        onDbclick(event, element)
// *        onBeforeDbclick(event, element)
// *        onAfterDbclick(event, element)
// *
// *        onClick(event, element)
// *        onBeforeClick(event, element)
// *        onAfterClick(event, element)
// *
// *        onMousedown(event, element)
// *        onBeforeMousedown(event, element)
// *        onAfterMousedown(event, element)
// *
// *        onMouseup(event, element)
// *        onBeforeMouseup(event, element)
// *        onAfterMouseup(event, element)
// *
// *    Methods
// *        isActive()
// *
// ************************************************************************** //
"use strict";

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-button]';
const CLASS_NAME_ACTIVE = 'active';

export default class ButtonComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
        this.element = node;
    }

    _onInit() 
    {
        this.on('click', {
            do    : this._click,
            before: this._beforeClick,
            after : this._afterClick,
        });
        this.on('mousedown', {
            do    : this._mousedown,
            before: this._beforeMousedown,
            after : this._afterMousedown,
        });
        this.on('mouseup', {
            do    : this._mouseup,
            before: this._beforeMouseup,
            after : this._afterMouseup,
        });
    }

    _toggle()
    {
        this.node.setAttribute('aria-pressed', this.node.classList.toggle(CLASS_NAME_ACTIVE))
    }

    
    _click(handler, event, element)
    {
        // Always Click script
        // --


        //  Custom Click script
        // --

        if (typeof handler.onClick === 'function')
        {
            handler.onClick(event, element); 
            return;
        }

        
        //  Default Click script
        // --
        
        // console.log("Default do click");
    }
    _beforeClick(handler, event, element)
    {
        // Always Before Click script
        // --


        //  Custom Before Click script
        // --

        if (typeof handler.onBeforeClick === 'function')
        {
            handler.onBeforeClick(event, element); 
            return;
        }

        
        //  Default Before Click script
        // --
        
        // console.log("Default do before click");
    }
    _afterClick(handler, event, element)
    {
        // Always After Click script
        // --


        //  Custom After Click script
        // --

        if (typeof handler.onAfterClick === 'function')
        {
            handler.onAfterClick(event, element); 
            return;
        }

        
        //  Default After Click script
        // --
        
        // console.log("Default do after click");
    }

    _mousedown(handler, event, element)
    {
        // Always Mousedown script
        // --


        //  Custom Mousedown script
        // --

        if (typeof handler.onMousedown === 'function')
        {
            handler.onMousedown(event, element); 
            return;
        }

        
        //  Default Mousedown script
        // --
        
        // console.log("Default do mousedown");
    }
    _beforeMousedown(handler, event, element)
    {
        // Always Before Mousedown script
        // --

        handler._toggle();


        //  Custom Before Mousedown script
        // --

        if (typeof handler.onBeforeMousedown === 'function')
        {
            handler.onBeforeMousedown(event, element); 
            return;
        }

        
        //  Default Before Mousedown script
        // --
        
        // console.log("Default do before mousedown");
    }
    _afterMousedown(handler, event, element)
    {
        // Always After Mousedown script
        // --


        //  Custom After Mousedown script
        // --

        if (typeof handler.onAfterMousedown === 'function')
        {
            handler.onAfterMousedown(event, element); 
            return;
        }

        
        //  Default After Mousedown script
        // --
        
        // console.log("Default do after mousedown");
    }

    _mouseup(handler, event, element)
    {
        // Always Mouseup script
        // --


        //  Custom Mouseup script
        // --

        if (typeof handler.onMouseup === 'function')
        {
            handler.onMouseup(event, element); 
            return;
        }

        
        //  Default Mouseup script
        // --
        
        // console.log("Default do mouseup");
    }
    _beforeMouseup(handler, event, element)
    {
        // Always Before Mouseup script
        // --


        //  Custom Before Mouseup script
        // --

        if (typeof handler.onBeforeMouseup === 'function')
        {
            handler.onBeforeMouseup(event, element); 
            return;
        }

        
        //  Default Before Mouseup script
        // --
        
        // console.log("Default do before mouseup");
    }
    _afterMouseup(handler, event, element)
    {
        // Always After Mouseup script
        // --
        
        handler._toggle();


        //  Custom After Mouseup script
        // --

        if (typeof handler.onAfterMouseup === 'function')
        {
            handler.onAfterMouseup(event, element); 
            return;
        }

        
        //  Default After Mouseup script
        // --
        
        // console.log("Default do after mouseup");
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new ButtonComponent(node));
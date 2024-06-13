"use strict";

const nativeEvents = new Set([
    'click',
    'dblclick',
    'mouseup',
    'mousedown',
    // 'contextmenu',
    // 'mousewheel',
    // 'DOMMouseScroll',
    // 'mouseover',
    // 'mouseout',
    // 'mousemove',
    // 'selectstart',
    // 'selectend',
    // 'keydown',
    // 'keypress',
    // 'keyup',
    // 'orientationchange',
    // 'touchstart',
    // 'touchmove',
    // 'touchend',
    // 'touchcancel',
    // 'pointerdown',
    // 'pointermove',
    // 'pointerup',
    // 'pointerleave',
    // 'pointercancel',
    // 'gesturestart',
    // 'gesturechange',
    // 'gestureend',
    // 'focus',
    // 'blur',
    'change',
    // 'reset',
    // 'select',
    // 'submit',
    // 'focusin',
    // 'focusout',
    // 'load',
    // 'unload',
    // 'beforeunload',
    // 'resize',
    // 'move',
    // 'DOMContentLoaded',
    // 'readystatechange',
    // 'error',
    // 'abort',
    // 'scroll'
])

export default class AbstractComponent
{
    _id;
    _node;
    _element;
    // _name;
    // _event;

    constructor(node)
    {
        this._node = node;
        this._id = node.id;
        if (typeof this._onInit === 'function') this._onInit();
    }

    on(handler, delegatedFunctions)
    {
        const [el, ev] = this._normalize(handler);

        // Stop event
        if (!el || !nativeEvents.has(ev) || !Object.keys(delegatedFunctions).length) return;

        el.addEventListener(ev, event => {
            
            event.preventDefault();
            event.stopImmediatePropagation();

            if (typeof delegatedFunctions.before === 'function') (delegatedFunctions.before)( this, event, event.target );
            if (typeof delegatedFunctions.do     === 'function') (delegatedFunctions.do)( this, event, event.target );
            if (typeof delegatedFunctions.after  === 'function') (delegatedFunctions.after)( this, event, event.target );
        });
    }

    off(handler)
    {
        const [el, ev] = this._normalize(handler);

        el.removeEventListener(ev);
    }

    _normalize(handler)
    {
        return typeof handler === 'string' ? [this._node, handler] : handler;
    }

    get node()
    {
        return this._node;
    }


    set element(element)
    {
        this._element = element;
    }
    get element()
    {
        return this._element;
    }


    set id(id)
    {
        this._id = id;
    }
    get id()
    {
        return this._id;
    }




    // Event Click
    // --
    
    _onClick; _onBeforeClick; _onAfterClick;

    set onClick(fn) {this._onClick = fn}
    set onBeforeClick(fn) {this._onBeforeClick = fn}
    set onAfterClick(fn) {this._onAfterClick = fn}

    get onClick() {return this._onClick}
    get onBeforeClick() {return this._onBeforeClick}
    get onAfterClick() {return this._onAfterClick}


    // Event DbClick
    // --
    
    _onDbclick; _onBeforeDbclick; _onAfterDbclick;

    set onDbclick(fn) {this._onDbclick = fn}
    set onBeforeDbclick(fn) {this._onBeforeDbclick = fn}
    set onAfterDbclick(fn) {this._onAfterDbclick = fn}

    get onDbclick() {return this._onDbclick}
    get onBeforeDbclick() {return this._onBeforeDbclick}
    get onAfterDbclick() {return this._onAfterDbclick}


    // Event Mouseup
    // --
    
    _onMouseup; _onBeforeMouseup; _onAfterMouseup;

    set onMouseup(fn) {this._onMouseup = fn}
    set onBeforeMouseup(fn) {this._onBeforeMouseup = fn}
    set onAfterMouseup(fn) {this._onAfterMouseup = fn}

    get onMouseup() {return this._onMouseup}
    get onBeforeMouseup() {return this._onBeforeMouseup}
    get onAfterMouseup() {return this._onAfterMouseup}


    // Event Mousedown
    // --
    
    _onMousedown; _onBeforeMousedown; _onAfterMousedown;

    set onMousedown(fn) {this._onMousedown = fn}
    set onBeforeMousedown(fn) {this._onBeforeMousedown = fn}
    set onAfterMousedown(fn) {this._onAfterMousedown = fn}

    get onMousedown() {return this._onMousedown}
    get onBeforeMousedown() {return this._onBeforeMousedown}
    get onAfterMousedown() {return this._onAfterMousedown}


    // Event Change
    // --

    _onChange; _onBeforeChange; _onAfterChange;

    set onChange(fn) {this._onChange = fn}
    set onBeforeChange(fn) {this._onBeforeChange = fn}
    set onAfterChange(fn) {this._onAfterChange = fn}

    get onChange() {return this._onChange}
    get onBeforeChange() {return this._onBeforeChange}
    get onAfterChange() {return this._onAfterChange}


    // 'contextmenu',
    // 'mousewheel',
    // 'DOMMouseScroll',
    // 'mouseover',
    // 'mouseout',
    // 'mousemove',
    // 'selectstart',
    // 'selectend',
    // 'keydown',
    // 'keypress',
    // 'keyup',
    // 'orientationchange',
    // 'touchstart',
    // 'touchmove',
    // 'touchend',
    // 'touchcancel',
    // 'pointerdown',
    // 'pointermove',
    // 'pointerup',
    // 'pointerleave',
    // 'pointercancel',
    // 'gesturestart',
    // 'gesturechange',
    // 'gestureend',
    // 'focus',
    // 'blur',
    // 'change',
    // 'reset',
    // 'select',
    // 'submit',
    // 'focusin',
    // 'focusout',
    // 'load',
    // 'unload',
    // 'beforeunload',
    // 'resize',
    // 'move',
    // 'DOMContentLoaded',
    // 'readystatechange',
    // 'error',
    // 'abort',
    // 'scroll'

    // set name(name)
    // {
    //     this._name = name;
    // }
    // get name()
    // {
    //     return this._name;
    // }

    // set event(event)
    // {
    //     this._event = event;
    // }
    // get event()
    // {
    //     return this._event;
    // }
}
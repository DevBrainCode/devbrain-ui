// ***************************** DevBrain Theme ***************************** //
// *
// *    Components: Carousel
// *
// ************************************************************************** //
// *
// *    <div rel="js-carousel">
// *
// ************************************************************************** //

import AbstractComponent from "./AbstractComponent";

const SELECTOR          = '[rel=js-carousel]';
const CLASS_NAME_ACTIVE = 'active';

export default class CarouselComponent extends AbstractComponent
{
    constructor(node)
    {
        super(node);
    }

    _onInit() 
    {
    }

    next()
    {
    }

    prev()
    {
    }

    to()
    {
    }

    pause()
    {
    }

    resume()
    {
    }

    cycle()
    {
    }
}

document.querySelectorAll(SELECTOR).forEach(node => new CarouselComponent(node));
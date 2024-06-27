let selector = '[rel=js-my-custom-button-handler]';
let trigger = document.querySelector( selector );
let btn = new ButtonToTopComponent( trigger );

btn.onClick = (event, element) => { ... }
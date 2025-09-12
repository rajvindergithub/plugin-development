 

var el = wp.element.createElement,
registerBlockType = wp.blocks.registerBlockType ;

 
registerBlockType( 'gutenberg/hello-world', {
title: 'Hello World',
icon: 'universal-access-alt', 
category: 'layout',
 
edit: function() {
    return el( 'div', { className: 'block-style' }, 'Rajvinder Singh' );
},
  
//edit: function() {
//    return el( 'div', { style: blockStyle }, 'Rajvinder Singh' );
//},
 
save: function() {
    return el( 'div', { className: 'block-style' }, 'Rajvinder Singh Saved!'  );
},
    
//    
//save: function() {
//    return el( 'div', { style: blockStyle }, 'Rajvinder Singh Saved!'  );
//},
    
    
    
} );

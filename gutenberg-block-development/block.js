 

var el = wp.element.createElement,
registerBlockType = wp.blocks.registerBlockType,
blockStyle = { backgroundColor: '#900', color: '#fff', padding: '20px' };

 
registerBlockType( 'gutenberg/hello-world', {
title: 'Hello World',
icon: 'universal-access-alt', 
category: 'layout',
 
edit: function() {
    return el( 'div', { style: blockStyle }, 'Rajvinder Singh' );
},
 
save: function() {
    return el( 'div', { style: blockStyle }, 'Rajvinder Singh Saved!'  );
},
} );

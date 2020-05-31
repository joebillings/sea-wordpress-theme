wp.domReady( () => {
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );
  
  wp.blocks.registerBlockStyle( 'core/button', {
		name: 'default',
		label: 'Default',
		isDefault: true,
	});

	// wp.blocks.registerBlockStyle( 'core/button', {
	// 	name: 'full',
	// 	label: 'Full Width',
	// });
} );

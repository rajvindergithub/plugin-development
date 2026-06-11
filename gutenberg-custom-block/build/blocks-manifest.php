<?php
// This file is generated. Do not modify it manually.
return array(
	'gutenberg-custom-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/gutenberg-custom-block',
		'version' => '0.1.0',
		'title' => 'Gutenberg Custom Block',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'images' => array(
				'type' => 'array',
				'default' => array(
					
				)
			)
		),
		'textdomain' => 'gutenberg-custom-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

 
import { useBlockProps } from '@wordpress/block-editor';
 
import './editor.scss';

 
export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			Rajvinder singh develop 
		</p>
	);
}

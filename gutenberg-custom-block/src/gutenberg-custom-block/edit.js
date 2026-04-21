
import { __ } from '@wordpress/i18n';

import {
	useBlockProps,
	MediaUpload,
	InspectorControls
} from '@wordpress/block-editor';

 import {
	PanelBody,
	TextControl,
	Button
} from '@wordpress/components';

import './editor.scss';


export default function Edit(  { attributes, setAttributes } ) {

	const { textValue, imageUrl } = attributes;

	return (
		<div { ...useBlockProps( ) }>
			 	<InspectorControls>
 					<PanelBody
					title="Upload Image for Image Gallery"
					initialOpen={true}
				>

					<TextControl label="Enter Gallery Heading" onChange={(value) =>
							setAttributes({ textValue: value })
						} value={textValue} />
				 
									<MediaUpload
						onSelect={(media) =>
							setAttributes({ imageUrl: media.url })
						}
						allowedTypes={['image']}
						render={({ open }) => (
							<Button
								onClick={open}
								variant="primary"
							>
								Upload Image
							</Button>
						)}
					/>


				</PanelBody>
				</InspectorControls>

<div className="gutenblog-preview">

				{textValue && (
					<h3>{textValue}</h3>
				)}

				{imageUrl && (
					<img
						src={imageUrl}
						alt=""
						style={{
							marginTop: '10px',
							maxWidth: '100%'
						}}
					/>
				)}

			</div>



		</div>
	);
}


import { __ } from '@wordpress/i18n';

import {
	useBlockProps,
	MediaUpload,
	InspectorControls, 
    MediaUploadCheck
} from '@wordpress/block-editor';

 import {
	PanelBody,
	TextControl,
	Button
} from '@wordpress/components';

 

export default function Edit(  { attributes, setAttributes } ) {

      const { images } = attributes;

    const onSelectImages = (media) => {

        const imageArray = media.map(img => ({
            id: img.id,
            url: img.url
        }));

        setAttributes({
            images: imageArray
        });
    };

    return(

            <div {...useBlockProps()}>
                  <MediaUploadCheck>
                    <MediaUpload 
                        onSelect={onSelectImages}
                        allowedTypes={['image']}
                        multiple={true}
                        gallery={true}
                        value={images.map(img => img.id)}
                        render={
                            ({open}) => (
                                    <Button variant='primary' onClick={open}>
                                        Upload Gallery Image
                                    </Button>
                            ) }   
                    />
                  </MediaUploadCheck>

                   {images.length > 0 && (

                        <div style={{
                                display: "flex",
                                gap: "10px",
                                marginTop: "15px",
                                flexWrap: "wrap"

                        }}>

                            {images.map((img, index) => (

                        <img
                            key={index}
                            src={img.url}
                            alt=""
                            style={{
                                width: "100px",
                                height: "100px",
                                objectFit: "cover"
                            }}
                        /> 


                            ))}

                        </div>

                   )}

            </div>


    )

 
}

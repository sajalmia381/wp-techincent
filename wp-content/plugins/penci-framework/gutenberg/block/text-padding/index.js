/**
 * External dependencies
 */
import classnames from 'classnames';

import {
	registerBlockType,
	__,
	PanelBody,
	SelectControl,
	PanelColorSettings,
	InspectorControls,
	RichText,
	ColorPalette,
	omit,
	merge,
	Fragment,
} from '../../wp-imports'

import { PenciIcon } from '../../icons'

registerBlockType( 'penci-gutenberg/text-padding', {
	title: __( 'Penci: text-padding' ),
	icon: PenciIcon,
	category: 'penci-blocks',

    edit( { className, attributes, setAttributes } ) {
        
		const paddingOptions = [
			{ value: 'penci-tpadding-1', label: __( 'Text ⇠' ) },
			{ value: 'penci-tpadding-2', label: __( '⇢ Text' ) },
			{ value: 'penci-tpadding-3', label: __( '⇢ Text ⇠' ) },
			{ value: 'penci-tpadding-4', label: __( '⇢ Text ⇠⇠' ) },
			{ value: 'penci-tpadding-5', label: __( '⇢⇢ Text ⇠' ) },
			{ value: 'penci-tpadding-6', label: __( '⇢⇢  Text ⇠⇠' ) },
			{ value: 'penci-tpadding-7', label: __( '⇢⇢⇢ Text ⇠⇠⇠' ) },
		];

		const classStylePre =  className + ' ' + attributes.classstyle;

        return (
           	<Fragment>
           	<InspectorControls>
				<PanelBody>
					<SelectControl
						label={ __( 'Padding style' ) }
						value={ attributes.classstyle }
						options={ paddingOptions.map( ({ value, label }) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newSize ) => { setAttributes( { classstyle: newSize } ) } }
					/>
				</PanelBody>
			</InspectorControls>
            <div className={ classStylePre }>
            <RichText
                tagName="div"
                className={ 'penci-padding-text' }
                value={ attributes.content }
                onChange={ ( content ) => setAttributes( { content } ) }
            />
            </div>
            </Fragment>
        );
    },

    save( { attributes } ) {
        return <RichText.Content tagName="div" value={ attributes.content } />;
    }
} );

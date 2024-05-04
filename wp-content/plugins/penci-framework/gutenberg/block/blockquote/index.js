import {
	registerBlockType,
	__,
	InspectorControls,
	BlockControls,
	RichText,
	TextControl,
	ToggleControl,
	BlockAlignmentToolbar,
	ColorPalette,
	PanelColorSettings,
	IconButton,
	Dashicon,
	SelectControl,
	RangeControl,
	URLInput,
	ServerSideRender,
	PanelBody,
	ContrastChecker,
	omit,
	merge,
	Fragment,
	TextareaControl,
} from '../../wp-imports'

import { PenciIcon } from '../../icons'

export const save = ( props ) => { return null }

export const edit = ( props ) => {
	const { isSelected, className, setAttributes } = props;
	const { content,style,author,align,font_weight,font_style,uppercase,text_size } = props.attributes;

	const selectStyle = [
		{ value: 'style-1', label: __( 'Style 1' ) },
		{ value: 'style-2', label: __( 'Style 2' ) },
		{ value: 'style-3', label: __( 'Style 3' ) },
	];

	const selectalign = [
		{ value: 'none', label: __( 'None' ) },
		{ value: 'left', label: __( 'Align Left' ) },
		{ value: 'center', label: __( 'Align Center' ) },
		{ value: 'right', label: __( 'Align Right' ) },
	];
	const selectfont_weight = [
		{ value: '', label: __( 'Default' ) },
		{ value: 'bold', label: __( 'Bold' ) },
		{ value: 'normal', label: __( 'Normal' ) },
		{ value: '100', label: __( '100' ) },
		{ value: '200', label: __( '200' ) },
		{ value: '300', label: __( '300' ) },
		{ value: '400', label: __( '400' ) },
		{ value: '500', label: __( '500' ) },
		{ value: '600', label: __( '600' ) },
		{ value: '700', label: __( '700' ) },
		{ value: '800', label: __( '800' ) },
		{ value: '900', label: __( '900' ) },
	];
	const selectfont_style = [
		{ value: '', label: __( 'Default' ) },
		{ value: 'italic', label: __( 'Italic' ) },
		{ value: 'normal', label: __( 'Normal' ) },
	];
	const selectuppercase = [
		{ value: '', label: __( 'Default' ) },
		{ value: 'yes', label: __( 'Yes' ) },
		{ value: 'false', label: __( 'No' ) }
	];

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody>
			       <TextControl
					label={ __( 'Quote Content' ) }
					value={ content }
					onChange={ ( newValue ) => setAttributes( { content: newValue } ) }
					/>
					<TextControl
				      	label={ __( 'Quote Author' ) }
				        value={ author }
				        onChange={ ( newValue ) => setAttributes( { author: newValue } ) }
				    />
					<SelectControl
						label={ __( 'Blockquote style' ) }
						value={ style }
						options={ selectStyle.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newValue ) => { setAttributes( { style: newValue } ) } }
					/>
					<SelectControl
						label={ __( 'Align' ) }
						value={ align }
						options={ selectalign.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newValue ) => { setAttributes( { align: newValue } ) } }
					/>
					<SelectControl
						label={ __( 'Blockquote Font Weight' ) }
						value={ font_weight }
						options={ selectfont_weight.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newValue ) => { setAttributes( { font_weight: newValue } ) } }
					/>
					<SelectControl
						label={ __( 'Font Style' ) }
						value={ font_style }
						options={ selectfont_style.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newValue ) => { setAttributes( { font_style: newValue } ) } }
					/>
					<SelectControl
						label={ __( 'Blockquote Font Weight' ) }
						value={ uppercase }
						options={ selectuppercase.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
					onChange={ ( newValue ) => { setAttributes( { uppercase: newValue } ) } }
					/>
					<TextControl
						label={ __( 'Font size' ) }
						value={ text_size }
						onChange={ ( newValue ) => setAttributes( { text_size: newValue } ) }
					/>
				</PanelBody>
			</InspectorControls>
			 <ServerSideRender
	            block="penci-gutenberg/blockquote"
	            attributes={ props.attributes }
	        />
		</Fragment>
	)
}

registerBlockType( 'penci-gutenberg/blockquote', {
	title: __( 'Penci: Blockquote' ),
	description: __( 'Maybe someone else said it better -- add some quoted text.' ),
	icon: PenciIcon,
	category: 'penci-blocks',
	edit: edit,
	save: save,
} );

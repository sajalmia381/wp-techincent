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
} from '../../wp-imports'

import { PenciIcon } from '../../icons'

export const save = ( props ) => { return null }

export const edit = ( props ) => {
	const { isSelected, className, setAttributes } = props;
	const { content,link,size,icon,icon_position,align,full,radius,target,nofollow,id,margin_bottom,text_color,background,text_hover_color,hover_bgcolor } = props.attributes;

	const buttonSizes = [
		{ value: '', label: __( 'Normal' ) },
		{ value: 'small', label: __( 'Small' ) },
		{ value: 'large', label: __( 'Large' ) },
	];

	const iconPosition = [
		{ value: 'left', label: __( 'Left' ) },
		{ value: 'right', label: __( 'Right' ) },
	];

	const selectLinktarget = [
		{ value: '', label: __( 'Default' ) },
		{ value: '_blank', label: __( 'New window/tab' ) },
	];

	const selectalign = [
		{ value: '', label: __( 'None' ) },
		{ value: 'left', label: __( 'Left' ) },
		{ value: 'center', label: __( 'Center' ) },
		{ value: 'right', label: __( 'Right' ) },
	];

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody>
					<TextControl
				      	label={ __( 'Button Text' ) }
				        value={ content }
				        onChange={ ( newValue ) => setAttributes( { content: newValue } ) }
				    />
				    <TextControl
				      	label={ __( 'Button Link' ) }
				        value={ link }
				        onChange={ ( newValue ) => setAttributes( { link: newValue } ) }
				    />
					<SelectControl
						label={ __( 'Size' ) }
						value={ size }
						options={ buttonSizes.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newSize ) => { setAttributes( { size: newSize } ) } }
					/>
					<TextControl
				      	label={ __( 'Icon' ) }
				        value={ icon }
				        onChange={ ( iconValue ) => setAttributes( { icon: iconValue } ) }
				    />
				    <SelectControl
						label={ __( 'Icon Position' ) }
						value={ icon_position }
						options={ iconPosition.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newSize ) => { setAttributes( { icon_position: newSize } ) } }
					/>
					<SelectControl
						label={ __( 'Align' ) }
						value={ align }
						options={ selectalign.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newalign ) => { setAttributes( { align: newalign } ) } }
					/>
					<SelectControl
						label={ __( 'Link Target' ) }
						value={ target }
						options={ selectLinktarget.map( ( { value, label } ) => ( {
							value: value,
							label: label,
						} ) ) }
						onChange={ ( newSize ) => { setAttributes( { target: newSize } ) } }
					/>
					<ToggleControl
						label={ __( 'Full Width' ) }
						checked={ full }
						onChange={ () => setAttributes( { full: ! full } ) }
					/>
					<ToggleControl
						label={ __( 'Nofollow' ) }
						checked={ nofollow }
						onChange={ () => setAttributes( { nofollow: ! nofollow } ) }
					/>
					<TextControl
				      	label={ __( 'ID' ) }
				        value={ id }
				        onChange={ ( btnIDValue ) => setAttributes( { id: btnIDValue } ) }
				    />
				    <TextControl
				      	label={ __( 'Margin button' ) }
				        value={ margin_bottom }
				        onChange={ ( marginbtnValue ) => setAttributes( { margin_bottom: marginbtnValue } ) }
				    />
				</PanelBody>
				<PanelColorSettings
					title={ __( 'Color Settings' ) }
					colorSettings={ [
						{
							value: text_color,
							onChange: ( colorValue ) => setAttributes( { text_color: colorValue } ),
							label: __( 'Custom Text Color' ),
						},
						{
							value: background,
							onChange: (colorValue ) => setAttributes( { background: colorValue } ),
							label: __( 'Custom Background Color' ),
						},
						{
							value: text_hover_color,
							onChange: ( colorValue ) => setAttributes( { text_hover_color: colorValue } ),
							label: __( 'Custom Text Hover Color' ),
						},
						{
							value: hover_bgcolor,
							onChange: ( colorValue ) => setAttributes( { hover_bgcolor: colorValue } ),
							label: __( 'Custom Background Hover Color' ),
						},
					] }
				>
				</PanelColorSettings>
			
			</InspectorControls>
			 <ServerSideRender
	            block="penci-gutenberg/button"
	            attributes={ props.attributes }
	        />
		</Fragment>
	)
}

registerBlockType( 'penci-gutenberg/button', {
	title: __( 'Penci: Button' ),
	description: __( 'Want visitors to click to subscribe, buy, or read more? Get their attention with a button.' ),
	icon: PenciIcon,
	category: 'penci-blocks',
	edit: edit,
	save: save,
} );

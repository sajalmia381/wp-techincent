import {
	registerBlockType,
	__,
	InspectorControls,
	BlockControls,
	RichText,
	ToggleControl,
	TextControl,
	BlockAlignmentToolbar,
	ColorPalette,
	PanelColorSettings,
	IconButton,
	Dashicon,
	SelectControl,
	RangeControl,
	URLInput,
	PanelBody,
	Toolbar,
	ContrastChecker,
	ServerSideRender,
	omit,
	merge,
	Fragment,
} from '../../wp-imports'

import { PenciIcon } from '../../icons'

const MIN_NUMBER= 1;
const MAX_NUMBER = 100;

 // Rendering in PHP
export const save = ( props ) => { return null }

export const edit = ( props ) => {
	const { isSelected, className, setAttributes } = props;
	const { title,number, style, align,withids, displayby, orderby, thumbright, background, border  } = props.attributes;

	const selectStyle = [
		{ value: 'list', label: __( 'List' ) },
		{ value: 'grid', label: __( 'Grid' ) },
	];

	const selectdisplayby = [
		{ value: 'recent_posts', label: __( 'Recent Posts' ) },
		{ value: 'cat', label: __( 'Categories' ) },
		{ value: 'tag', label: __( 'Tags' ) },
	];

	const selectorderby = [
		{ value: 'random', label: __( 'Random' ) },
		{ value: 'date', label: __( 'Post date' ) },
		{ value: 'title', label: __( 'Post title' ) },
	];

	const layoutControls = [
			{
				icon: 'list-view',
				title: __( 'List View' ),
				onClick: () => setAttributes( { style: 'list' } ),
				isActive: style === 'list',
			},
			{
				icon: 'grid-view',
				title: __( 'Grid View' ),
				onClick: () => setAttributes( { style: 'grid' } ),
				isActive: style === 'grid',
			},
		];

	 return (
       <Fragment>
       <BlockControls>
			<Toolbar controls={ layoutControls } />
		</BlockControls>		
       <InspectorControls>
			<PanelBody title={ __( 'Related Posts Settings' ) }>
				<TextControl
			      	label={ __( 'Title' ) }
			        value={ title }
			        onChange={ ( newValue ) => setAttributes( { title: newValue } ) }
			    />
			    <RangeControl
					label={ __( 'Numbers Post to Show?' ) }
					value={ number }
					onChange={ ( newValue ) => setAttributes( { number: newValue } ) }
					min={ MIN_NUMBER }
					max={ MAX_NUMBER }
				/>
				<SelectControl
					label={ __( 'Style' ) }
					value={ style }
					options={ selectStyle.map( ( { value, label } ) => ( {
						value: value,
						label: label,
					} ) ) }
					onChange={ ( newValue ) => { setAttributes( { style: newValue } ) } }
				/>
				<TextControl
				label={ __( 'Display Related Posts With Post Ids. ( Enter here separated by comas. Example: 12, 14 )' ) }
				value={ withids }
				onChange={ ( newValue ) => setAttributes( { withids: newValue } ) }
				/>
				<SelectControl
					label={ __( 'Display Related Posts By' ) }
					value={ displayby }
					options={ selectdisplayby.map( ( { value, label } ) => ( {
						value: value,
						label: label,
					} ) ) }
					onChange={ ( newValue ) => { setAttributes( { displayby: newValue } ) } }
				/>
				<SelectControl
					label={ __( 'Order Related Posts' ) }
					value={ orderby }
					options={ selectorderby.map( ( { value, label } ) => ( {
						value: value,
						label: label,
					} ) ) }
					onChange={ ( newValue ) => { setAttributes( { orderby: newValue } ) } }
				/>
				{ style === 'grid' &&
				<ToggleControl
					label={ __( 'Enable thumbnail right?' ) }
					checked={ thumbright }
					onChange={ () => setAttributes( { thumbright: ! thumbright } ) }
				/>
				}
			</PanelBody>
			<PanelColorSettings
					title={ __( 'Color Settings' ) }
					colorSettings={ [
						{
							value: background,
							onChange: ( colorValue ) => setAttributes( { background: colorValue } ),
							label: __( 'Background Color' ),
						},
						{
							value: border,
							onChange: (colorValue ) => setAttributes( { border: colorValue } ),
							label: __( 'Custom Color' ),
						}
					] }
				>
			</PanelColorSettings>
		</InspectorControls>
        <ServerSideRender
            block="penci-gutenberg/related-posts"
            attributes={ props.attributes }
        />
        </Fragment>
    );
}

registerBlockType( 'penci-gutenberg/related-posts', {
	title: __( 'Penci: Inline Related Posts' ),
	icon: PenciIcon,
	category: 'penci-blocks',
	edit: edit,
	save: save,
} );

/**
 * External dependencies
 */
import classnames from 'classnames';

import {
	registerBlockType,
	__,
	Autocomplete, 
	InspectorControls,
	RangeControl,
	TextControl,
	PanelBody,
	Fragment,
} from '../../wp-imports'

import { PenciIcon } from '../../icons'

 // Rendering in PHP
export const save = ( props ) => { return null }

export const edit = ( props ) => {
	const { isSelected } = props;
	const { height } = props.attributes;
	const autocompleters = [
        {
            name: 'fruit',
            // The prefix that triggers this completer
            triggerPrefix: '~',
            // The option data
            options: [
                { visual: '', name: 'Apple', id: 1 },
                { visual: '', name: 'Orange', id: 2 },
                { visual: '', name: 'Grapes', id: 3 },
            ],
            // Returns a label for an option like " Orange"
            getOptionLabel: option => (
                <span>
                    <span className="icon" >{ option.visual }</span>{ option.name }
                </span>
            ),
            // Declares that options should be matched by their name
            getOptionKeywords: option => [ option.name ],
            // Declares that the Grapes option is disabled
            isOptionDisabled: option => option.name === 'Grapes',
            // Declares completions should be inserted as abbreviations
            getOptionCompletion: option => (
                <abbr title={ option.name }>{ option.visual }</abbr>
            ),
        }
    ];

	return (
		<Fragment>
		 <Autocomplete completers={ autocompleters }>
                { ( { isExpanded, listBoxId, activeId } ) => (
                    <div
                        contentEditable
                        suppressContentEditableWarning
                        aria-autocomplete="list"
                        aria-expanded={ isExpanded }
                        aria-owns={ listBoxId }
                        aria-activedescendant={ activeId }
                    >
                    </div>
                ) }
            </Autocomplete>
			<InspectorControls>
				<PanelBody>
					<RangeControl
						label={__('Height')}
						value={ height }
						min='1'
						max='500'
						onChange={ ( height ) => { props.setAttributes( { height } ) } }
					/>
				</PanelBody>
			</InspectorControls>
			<div className={ props.className } style={ { height: height + 'px' } }></div>
		</Fragment>
	)
}

registerBlockType( 'penci-gutenberg/custom-list', {
	title: __( 'Penci: Custom list' ),
	icon: PenciIcon,
	category: 'penci-blocks',
	edit: edit,
	save: save,
} );

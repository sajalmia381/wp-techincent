/* ----------------------------------------------------- */
/* This file for register button insert shortcode to TinyMCE
 /* ----------------------------------------------------- */
(function () {
	tinymce.create( 'tinymce.plugins.penci_pre_shortcodes_button', {
		init         : function ( ed, url ) {
			title = 'penci_pre_shortcodes_button';
			tinymce.plugins.penci_pre_shortcodes_button.theurl = url;

			var lorem = 'I am text column. Click edit button to change this text.';

			var $taxonomies_current_pre = [{ text: 'Recent Posts', value: 'recent_posts' }, { text: 'Categories', value: 'cat' }, { text: 'Tags', value: 'tag' }];
			if (typeof $taxonomies_current !== 'undefined') {
			   $taxonomies_current_pre = $taxonomies_current;
			}

			ed.addButton( 'penci_pre_shortcodes_button', {
				title: 'Select Shortcode',
				text: 'PenNews',
				icon : 'wp_code',
				type : 'menubutton',
				menu : [
					{text: 'Text Padding',classes: 'text-padding', menu: [
						{
							text: 'Text ⇠',
							value: 'text-padding-right-1',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-1">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢ Text',
							value: 'text-padding-left-1',
							onclick: function () {
								content = ed.selection.getContent();
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-2">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢ Text ⇠',
							value: 'text-padding-1',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-3">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢ Text ⇠⇠',
							value: 'text-padding-right-2',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-4">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢⇢ Text ⇠',
							value: 'text-padding-left-2',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-5">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢⇢  Text ⇠⇠',
							value: 'text-padding-2',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-6">' + ed.selection.getContent() + '</div>');
							}
						},
						{
							text: '⇢⇢⇢ Text ⇠⇠⇠',
							value: 'text-padding-3',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<div class="penci-tpadding-7">' + ed.selection.getContent() + '</div>');
							}
						},
					]},
					{text: 'Drop cap',classes: 'drop-cap', menu: [
						{
							text: 'Box',
							value: 'penci-dropcap-box',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-box">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Box Outline',
							value: 'penci-dropcap-box',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-box-outline">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Circle',
							value: 'penci-dropcap-circle',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-circle">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'CircleOutline',
							value: 'penci-dropcap-circle',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-circle-outline">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Regular',
							value: 'penci-dropcap-regular',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-regular">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Bold',
							value: 'penci-dropcap-bold',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-dropcap-bold">' + ed.selection.getContent() + '</span>');
							}
						}
					]},
					{text: 'Text highlight',classes: 'text-highlight', menu: [
						{
							text: 'Black',
							value: 'penci-highlight-black',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlight-black">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Black',
							value: 'penci-highlighted-black',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-black">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Red',
							value: 'penci-highlight-red',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-red">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Blue',
							value: 'penci-highlight-blue',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-blue">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Green',
							value: 'penci-highlight-green',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-green">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Yellow',
							value: 'penci-highlight-yellow',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-yellow">' + ed.selection.getContent() + '</span>');
							}
						},
						{
							text: 'Highlighted Pink',
							value: 'penci-highlight-pink',
							onclick: function () {
								ed.execCommand('mceInsertContent', 0, '<span class="penci-highlighted-pink">' + ed.selection.getContent() + '</span>');
							}
						}
					]},
					{text   : 'Button',
						value  : 'Button',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'Button',
								body    : [
									{ type: 'textbox', name: 'content', label: 'Text', value: 'Click me' },
									{ type: 'textbox', name: 'link', label: 'Link', value: '#' },
									{ type: 'textbox', name: 'text_color', label: 'Custom Text Color', value: '' },
									{ type: 'textbox', name: 'background', label: 'Custom Background Color', value: '' },
									{ type: 'textbox', name: 'text_hcolor', label: 'Custom Text Hover Color', value: '' },
									{ type: 'textbox', name: 'hbackground', label: 'Custom Background Hover Color', value: '' },
									{ type: 'listbox', name: 'size', label   : 'Size', 'values': [{ text: 'Default', value: '' }, { text: 'Small', value: 'small' }, { text: 'Large', value: 'large' }] },
									{ type: 'textbox', name: 'icon', label: 'Icon', value: 'fa fa-address-book' },
									{ type: 'listbox', name: 'icon_position', label   : 'Icon Position', 'values': [{ text: 'Left', value: 'left' }, { text: 'Right', value: 'right' }] },
									{ type: 'listbox', name: 'align', label   : 'Align', 'values': [{ text: 'None', value: '' }, { text: 'Left', value: 'left' }, { text: 'Center', value: 'center' }, { text: 'Right', value: 'right' }] },
									{ type: 'listbox', name: 'full', label   : 'Full Width', 'values': [{ text: 'No', value: '' }, { text: 'Yes', value: '1' }] },
									{ type: 'listbox', name: 'target', label   : 'Link Target', 'values': [{ text: 'Default', value: '' }, { text: 'New window/tab', value: '_blank' }] },
									{ type: 'listbox', name: 'nofollow', label   : 'Nofollow', 'values': [{ text: 'No', value: '' }, { text: 'Yes', value: '1' }] },
									{ type: 'textbox', name: 'id', label: 'ID', value: '' },
									{ type: 'textbox', name: 'class', label: 'Class', value: '' },
									{ type: 'textbox', name: 'margin_bottom', label: 'Margin button', value: '' },
								],
								onsubmit: function ( e ) {
									content = ed.selection.getContent();

									var $shortcode = '[penci_button  link="' + e.data.link + '" icon="' + e.data.icon + '" icon_position="' + e.data.icon_position + '"' +
									                 ( e.data.align ? ' align="' + e.data.align + '"' : '' ) +
									                 ( e.data.full ? ' full="' + e.data.full + '"' : '' ) +
									                 ( e.data.size ? ' size="' + e.data.size + '"' : '' ) +
									                 ( e.data.text_color ? ' text_color="' + e.data.text_color + '"' : '' ) +
									                 ( e.data.background ? ' background="' + e.data.background + '"' : '' ) +
									                 ( e.data.text_hcolor ? ' text_hover_color="' + e.data.text_hcolor + '"' : '' ) +
									                 ( e.data.hbackground ? ' hover_bgcolor="' + e.data.hbackground + '"' : '' ) +
									                 ( e.data.target ? ' target="' + e.data.target + '"' : '' ) +
									                 ( e.data.nofollow ? ' nofollow="' + e.data.nofollow + '"' : '' ) +
									                 ( e.data.id ? ' id="' + e.data.id + '"' : '' ) +
									                 ( e.data.class ? ' class="' + e.data.class + '"' : '' ) +
									                 ( e.data.margin_bottom ? ' margin_bottom="' + e.data.margin_bottom + '"' : '' ) +
									                 ']' +
									                 e.data.content + '[/penci_button]';

									ed.execCommand('mceInsertContent', 0, $shortcode );
								}
							} );
						}
					},
					{
						text   : 'Blockquote',
						value  : 'Blockquote',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'Blockquote',
								body    : [
									{ type: 'textbox', name: 'content', label: 'Quote Content', value: '' },
									{ type: 'textbox', name: 'author', label: 'Quote Author', value: '' },
									{ type: 'listbox', name: 'style',  label   : 'Blockquote style',value: 'style-1', 'values': [{ text: 'Style 1', value: 'style-1' }, { text: 'Style 2', value: 'style-2' },{ text: 'Style 3', value: 'style-3' }] },
									{ type: 'listbox', name: 'align', label   : 'Quote Align', 'values': [{ text: 'None', value: 'none' }, { text: 'Aligh Left', value: 'left' }, { text: 'Aligh Right', value: 'right' }] },
									{ type: 'listbox', name: 'font_weight', value: '', label   : 'Blockquote Font Weight', 'values': [{ text: 'Default', value: '' },{ text: 'Bold', value: 'bold' }, { text: 'Normal', value: 'normal' },{ text: '100', value: '100' },{ text: '200', value: '200' },{ text: '300', value: '300' },{ text: '400', value: '400' },{ text: '500', value: '500' },{ text: '600', value: '600' },{ text: '700', value: '700' },{ text: '800', value: '800' },{ text: '900', value: '900' }] },
									{ type: 'listbox', name: 'font_style', value: '', label   : 'Font Style', 'values': [{ text: 'Default', value: '' },{ text: 'Italic', value: 'italic' }, { text: 'Normal', value: 'normal' }] },
									{ type: 'listbox', name: 'uppercase', value: '', label   : 'Uppercase', 'values': [{ text: 'Default', value: '' },{ text: 'Yes', value: 'true' }, { text: 'No', value: 'false' }] },
									{ type: 'textbox', name: 'font_size', label: 'Font size', value: '' },
								],
								onsubmit: function ( e ) {
									var shortcode = '[penci_blockquote style="' + e.data.style + '" align="' + e.data.align + '" author="' + e.data.author + '"' +
									                ( e.data.font_weight ? ' font_weight="' + e.data.font_weight + '"' : '' ) +
									                ( e.data.font_style ? ' font_style="' + e.data.font_style + '"' : '' ) +
									                ( e.data.uppercase ? ' uppercase="' + e.data.uppercase + '"' : '' ) +
									                ( e.data.font_size ? ' text_size="' + e.data.font_size + '"' : '' ) +
									                ']' +
									                e.data.content +
									                '[/penci_blockquote]';

									ed.execCommand('mceInsertContent', 0, shortcode );
								}
							} );
						}
					},
					{
						text   : 'Related posts',
						value  : 'Related posts',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'Related posts',
								body    : [
									{ type : 'textbox', name : 'title', label: 'Title', value: 'Inline Related Posts' },
									{ type : 'textbox', name : 'number', label: 'Numbers Post to Show?', value: '4' },
									{ type : 'listbox', name    : 'style', label   : 'Select type', 'values': [{ text: 'List', value: 'list' }, { text: 'Grid', value: 'grid' }] },
									{ type: 'listbox', name: 'align', label: 'Select align', 'values': [{ text: 'None', value: 'none' }, { text: 'Left', value: 'left' }, { text: 'Right', value: 'right' }], },
									{ type : 'textbox', name : 'withids', label: 'Display Related Posts With Post Ids. ( Enter here separated by comas. Example: 12, 14 )', value: '' },
									{ type: 'listbox', name: 'displayby', label: 'Display Related Posts By', 'values': $taxonomies_current_pre },
									{ type: 'listbox', name: 'orderby', label: 'Order Related Posts', 'values': [{ text: 'Random', value: 'rand' }, { text: 'Post date', value: 'date' }, { text: 'Post title', value: 'title' }], },
									{ type : 'listbox', name    : 'thumbright', label   : 'Enable thumbnail right?', 'values': [{ text: 'No', value: 'no' }, { text: 'Yes', value: 'yes' }] },
									{ type : 'listbox', name    : 'dis_pview', label   : 'Disable post views with layout grid?', 'values': [{ text: 'No', value: 'no' }, { text: 'Yes', value: 'yes' }] },
									{ type : 'listbox', name    : 'dis_pdate', label   : 'Disable post date with layout grid?', 'values': [{ text: 'No', value: 'no' }, { text: 'Yes', value: 'yes' }] },
									{ type : 'textbox', name : 'background', label: 'Background Color' },
									{ type : 'textbox', name : 'border', label: 'Custom Border Color' },
								],
								onsubmit: function ( e ) {
									content = ed.selection.getContent();
									ed.execCommand('mceInsertContent', 0, '[penci_related_posts dis_pview="' + e.data.dis_pview + '" dis_pdate="' + e.data.dis_pdate + '" title="' + e.data.title + '" background="' + e.data.background + '" border="' + e.data.border + '"  thumbright="' + e.data.thumbright + '" number="' + e.data.number + '" style="' + e.data.style + '" align="' + e.data.align + '" withids="' + e.data.withids + '" displayby="' + e.data.displayby + '" orderby="' + e.data.orderby + '"]' );
								}
							} );
						}

					},
					{text: 'Columns',classes: 'columns', menu: [
						{
							text: '2 Columns',
							value: 'penci-2columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-6">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-6">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						},
						{
							text: '3 Columns',
							value: 'penci-3columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-4">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-4">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-4">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						},
						{
							text: '4 Columns',
							value: 'penci-4columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						}, {
							text: '1/3 + 2/3',
							value: 'penci-4columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-4">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-8">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						}, {
							text: '2/3 + 1/3',
							value: 'penci-4columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-8">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-4">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						}, {
							text: '1/4 + 3/4',
							value: 'penci-4columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-9">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						}, {
							text: '3/4 + 1/4',
							value: 'penci-4columns',
							onclick: function () {
								var shortcode = '<div class="penci-row">' +
								                '<div class="pencisc-col penci-col-9">' + lorem + '</div>' +
								                '<div class="pencisc-col penci-col-3">' + lorem + '</div>' +
								                '</div>';
								ed.execCommand('mceInsertContent', 0, shortcode );
							}
						}
					]},
					{text: 'Custom list',classes: 'custom-list', menu: [
						{
							text: 'Check List',
							value: 'penci-check-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-checklist' ), 200 );
							}
						},
						{
							text: 'Star List',
							value: 'penci-star-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-starlist' ), 200 );
							}
						},
						{
							text: 'Edit List',
							value: 'penci-edit-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-editlist' ), 200 );
							}
						},{
							text: 'Thumbup List',
							value: 'penci-thumbup-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-thumbuplist' ), 200 );
							}
						},{
							text: 'Thumbdown List',
							value: 'penci-thumbdown-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-thumbdownlist' ), 200 );
							}
						},{
							text: 'Plus List',
							value: 'penci-plus-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-pluslist' ), 200 );
							}
						},
						{
							text: 'Minus  List',
							value: 'penci-minus-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-minuslist' ), 200 );
							}
						},
						{
							text: 'Asterisk List',
							value: 'penci-asterisk-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-asterisklist' ), 200 );
							}
						},
						{
							text: 'Folder List',
							value: 'penci-folder-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-folderlist' ), 200 );
							}
						},
						{
							text: 'Heart List',
							value: 'penci-heart-list',
							onclick: function () {
								ed.execCommand("InsertUnorderedList", false);
								setTimeout( PenciInsertUnorderedList( ed , 'penci_list-heartlist' ), 200 );
							}
						}
					]},
					/* --- Penci Review --- */
					{
						text   : 'Penci Review',
						value  : 'Penci Review',
						onclick: function () {
							ed.insertContent( '[penci_review]' );
						}
					},
					/* --- Penci Recipe --- */
					{
						text   : 'Penci Recipe',
						value  : 'Penci Recipe',
						onclick: function () {
							ed.insertContent( '[penci_recipe]' );
						}
					},
					{
						text   : 'Penci Recipe Index',
						value  : 'Penci Recipe Index',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'Penci Recipe Index',
								body    : [
									{ type : 'textbox', name : 'title', label: 'Recipe Index Title', value: 'My Recipe Index' },
									{ type : 'textbox', name : 'cat', label: 'Recipe Index Category Slug' },
									{ type : 'textbox', name : 'numbers_posts', label: 'Numbers Posts to Show?', value: '3' },
									{ type    : 'listbox', name    : 'columns', label   : 'Select Columns', 'values': [{ text: '3 Columns', value: '3' }, { text: '2 Columns', value: '2' }, { text: '4 Columns', value: '4' }] },
									{ type    : 'listbox', name    : 'display_title', label   : 'Display Posts Title?', 'values': [{ text: 'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
									{ type    : 'listbox', name    : 'display_cat', label   : 'Display Posts Categories?', 'values': [{ text: 'No', value: 'no' }, { text: 'Yes', value: 'yes' }] },
									{ type    : 'listbox', name    : 'primary_cat', label   : 'Only Show Primary Category?', 'values': [{ text: 'Yes', value: 'yes' },{ text: 'No', value: 'no' }] },
									{ type    : 'listbox', name    : 'display_date', label   : 'Display Posts Date?', 'values': [{ text: 'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
									{ type    : 'listbox', name    : 'display_image', label   : 'Display Posts Featured Image?', 'values': [{ text: 'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
									{ type    : 'listbox', name    : 'image_size', label   : 'Images Size for Featured Image', 'values': [{ text: 'Landscape', value: 'landscape' },{ text: 'Square', value: 'square' }, { text: 'Vertical', value: 'vertical' }] },
									{ type    : 'listbox', name    : 'cat_link', label   : 'Display View All Posts ( Category Link )?', 'values': [{ text: 'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
									{ type : 'textbox', name : 'cat_link_text', label: 'Custom "View All" button text', value: 'View All' }
								],
								onsubmit: function ( e ) {
									ed.insertContent( '[penci_index title="' + e.data.title + '" cat="' + e.data.cat + '" numbers_posts="' + e.data.numbers_posts + '" columns="' + e.data.columns + '" display_title="' + e.data.display_title + '" display_cat="' + e.data.display_cat + '" display_date="' + e.data.display_date + '" display_image="' + e.data.display_image + '" image_size="' + e.data.image_size + '" cat_link="' + e.data.cat_link + '" cat_link_text="' + e.data.cat_link_text + '" /]' );
								}
							} );
						}
					},
					{
						text   : 'Clear element',
						value  : 'Clear element',
						selector : 'a,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,code,blockquote',
						onclick: function () {
							ed.execCommand('mceInsertContent', 0, '<div style="clear: both;"> ' + ed.selection.getContent() + '</div>' );

						}
					},
					{
						text   : 'Iframe ',
						value  : 'Iframe',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'Iframe',
								body    : [
									{ type: 'textbox', name: 'content', label: 'Url or Embed code', value: '' },
									{ type: 'listbox', name: 'align', label   : 'Align', 'values': [{ text: 'Default', value: '' }, { text: 'Left', value: 'left' }, { text: 'Center', value: 'center' }, { text: 'Right', value: 'right' }] },
									{ type: 'textbox', name: 'max_width', label: 'Max width ( Unit is pixel )', value: '' },
									{ type: 'textbox', name: 'margin_top', label: 'Margin top ( Unit is pixel )', value: '' },
									{ type: 'textbox', name: 'margin_bottom', label: 'Margin button ( Unit is pixel )', value: '' },
									{ type: 'textbox', name: 'height', label: 'Custom iframe height ( Unit is pixel )', value: '' },
								],
								onsubmit: function ( e ) {
									content = ed.selection.getContent();

									var $shortcode = '[penci_iframe' +
									                 ( e.data.align ? ' align="' + e.data.align + '"' : '' ) +
									                 ( e.data.max_width ? ' mwidth="' + e.data.max_width + '"' : '' ) +
									                 ( e.data.margin_top ? ' mtop="' + e.data.margin_top + '"' : '' ) +
									                 ( e.data.margin_bottom ? ' mbottom="' + e.data.margin_bottom + '"' : '' ) +
									                 ( e.data.height ? ' height="' + e.data.height + '"' : '' ) +
									                 ']' +
									                 e.data.content + '[/penci_iframe]';


									ed.execCommand('mceInsertContent', 0, $shortcode );
								}
							} );
						}
					}
				]
			} );

		},
		createControl: function ( n, cm ) {
			return null;
		}
	} );

	tinymce.PluginManager.add( 'penci_pre_shortcodes_button', tinymce.plugins.penci_pre_shortcodes_button );

	function PenciInsertUnorderedList( ed, styleList ){
		var $checkList = $( ed.dom.getParent( ed.selection.getNode(), 'ul' ) );

		if ( $checkList.hasClass( 'penci_list_shortcode' ) && $checkList.hasClass( styleList ) ) {
			$checkList.removeClass( styleList ).removeClass( 'penci_list_shortcode' );
		} else if ( $checkList.hasClass( 'penci_list_shortcode' ) && ! $checkList.hasClass( styleList ) ) {
			$checkList[0].className = $checkList[0].className.replace( /penci_list\-.*/ig, '' ).trim();
			$checkList.addClass( 'penci_list_shortcode' );
		} else {
			$checkList.addClass( 'penci_list_shortcode' ).addClass( styleList );
		}
	}

})();
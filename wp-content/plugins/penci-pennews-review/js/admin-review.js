jQuery( function ( $ ) {
	'use strict';

	function addPointReview(){
		var $listReview =  $('#pennews-add-review-list');
		$listReview.sortable();

		$('body').on('click', '#pennews-add-review' , function (e) {
			e.preventDefault();

			var $html = '<li class="penci-review-item">' +
			            '<span class="penci-format-row">' + PenciReview.review_title + '</span>' +
			            '<input style="width:250px;" type="text" name="penci_review_more['+ ReviewIndex + '][title]"  value="">' +
			            '<div class="clearfix"></div>' +
			            '<span class="penci-format-row">' + PenciReview.review_number + '</span>' +
			            '<input style="width:250px;" type="number" name="penci_review_more['+ ReviewIndex + '][number]" value="">' +
			            '<input type="hidden" name="penci_review_more['+ ReviewIndex + '][id]" value="id_' + Math.floor((Math.random() * 100000000 ) + 1) + '">' +
			            '<span class="penci-recipe-description">' + PenciReview.review_desc + '</span>' +
			            '<a class="button penci-btn-remove-review"><span class="dashicons dashicons-trash"></span> Delete</a>' +
			            '</li>';
			$listReview.append($html);

			ReviewIndex ++ ;

		});

		$('body').on('click', '.penci-btn-remove-review' , function (e) {
			e.preventDefault();

			$( this ).parent().fadeOut(function() {
				$( this ).remove();
			});
		});
	}

	function ApplyVerifiedBadge(){
		var $urVerify = $( '.penci-ur-verify' );

		if( ! $urVerify.length ){
			return false;
		}

		$urVerify.each( function( e ){
			var $this = $( this );

			$this.on( 'click', function(){
				event.preventDefault();
				var $this = $( this ),
					$parent = $this.closest( '.penci_review ' ),
					$type = $this.attr( 'data-action' ),
					$commentID = $this.attr( 'data-comment-id' ),
					$rmVerified = $this.attr( 'data-rmverified' );

				$parent.next( '#inline-edit-row' ).remove();

				$.ajax( {
					type: "POST",
					url: PenciReview.ajaxUrl,
					data: {
						action: 'penci_review_verify_badge',
						nonce: PenciReview.nonce,
						commentID: $commentID,
						type: $type	,
					},
					success: function ( response ) {
						if ( response.success ) {

							var $verified = $this.html();
							$this.attr( 'data-rmverified', $verified );
							$this.attr( 'data-action', response.data.type );
							$this.html( $rmVerified );

							if( 'unverify' === response.data.type ){
								$parent.find('.urreview_title').append('<span class="button button-verify-badge" style=" background: #be2459; color: #fff;border: 0;">Verified</span>');
							}else {
								$parent.find('.button-verify-badge').remove();
							}

						}
					}
				} );
				$parent.next( '#inline-edit-row' ).remove();
				return false;
			} );
		} );

		return false;
	}
	
	function userrateyoReivew() {
		if ( ! $( ".penci-reivew-star-rateYo" ).length ) {
			return false;
		}

		$( ".penci-reivew-star-rateYo" ).each( function( ){

			var $rateYo = $( this ),
				rating = $rateYo.attr( 'data-rating' );

			
			var	$input = $rateYo.next( '.penci-reivew-star-value' ),
				value = $input.val();

			$rateYo.rateYo( {
				rating: value,
				fullStar: true,
				starWidth: "18px",
				spacing: "3px",
				normalFill: PENCI.normalFill,
				ratedFill: PENCI.ratedFill,
			} ).on( "rateyo.change", function ( e, data ) {
				var rating = data.rating;
				$( this ).next().val( rating );
			} );
			
		} );
	}

	function widgetImg() {
		var frame = wp.media( {
			title: PenciReview.WidgetImageTitle,
			multiple: false,
			library: {type: 'image'},
			button: {text: PenciReview.WidgetImageButton}
		} );

		$( 'body' )
			.on( 'click', '.penci-widget-image__select', function ( e ) {

				e.preventDefault();
				var $this = $( this ),
					$input = $this.siblings( 'input' ),
					$image = $this.siblings( 'img' ),
					$placeholder = $this.prev(),
					$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

				frame.off( 'select' )
				     .on( 'select', function () {
					     var id = frame.state().get( 'selection' ).toJSON()[0].id;
					     var url = frame.state().get( 'selection' ).toJSON()[0].url;
					     $input.val( id );
					     $input.data( 'url', url );
					     $image.attr( 'src', url ).removeClass( 'hidden' );
					     $placeholder.addClass( 'hidden' );
					     $savewidget.prop( "disabled", false );
				     } )
				     .open();
			} )
			.on( 'click', '.penci-widget-image__remove', function ( e ) {
				e.preventDefault();
				var $this = $( this ),
					$input = $this.siblings( 'input' ),
					$image = $this.siblings( 'img' ),
					$placeholder = $this.prev().prev(),
					$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

				$input.val( '' );
				$image.addClass( 'hidden' );
				$placeholder.removeClass( 'hidden' );
				$savewidget.prop( "disabled", false );
			} )
			.on( 'change', '.penci-widget-image__input', function ( e ) {
				e.preventDefault();
				var $this = $( this ),
					url = $this.data( url ),
					$image = $this.siblings( 'img' );
				$image.attr( 'src', url )[url ? 'removeClass' : 'addClass']( 'hidden' );


			} );
	};


	function changeReviewSchema( ) {
		$('#penci_review_schema_markup').on( 'change', function() {
			var selected_val = $(this).val();

			$( '.penci-review_schema_fields' ).hide();
			$( '.penci-review_' + selected_val +  '_fields' ).show();
		}).change();
		$( '.penci-datepicker' ).datepicker();
	}


	$( document ).ready( function () {
		addPointReview();
		ApplyVerifiedBadge();
		userrateyoReivew();
		widgetImg();
		changeReviewSchema();
	} );

});
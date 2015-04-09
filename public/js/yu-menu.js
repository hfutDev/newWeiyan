$(function() {
				var $menu = $('#menu');

				//	Toggle menu 
				$('#open-icon-menu a').click(function( e ) {
					e.stopImmediatePropagation();
					e.preventDefault();
					$menu.trigger( $menu.hasClass( 'mm-opened' ) ? 'close.mm' : 'open.mm' );					
				});

				//	Create the menu
				$menu.mmenu({
					onClick: {
						preventDefault	: true,
						setSelected		: false
					}
				});

				//	Click an anchor, scroll to section
				$menu
					.find( 'a' )
					.on( 'click',
						function()
						{
							var href = $(this).attr( 'href' );
							if ( $menu.hasClass( 'mm-opened' ) )
							{
								$menu
									.off( 'closed.mm' )
									.one( 'closed.mm',
										function()
										{
											setTimeout(
												function()
												{
													$('html, body').animate({
														scrollTop: $( href ).offset().top
													});
												}, 10
											);
										}
									);
							}
							else
							{
								$('html, body').animate({
									scrollTop: $( href ).offset().top
								});
							}
						}
					);
			});
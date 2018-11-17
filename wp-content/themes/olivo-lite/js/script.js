var $container_isotope, args_isotope;
( function( $ ) {
    "use strict";
    
    $(document).ready(function($) {


        /*
        Sidebar
        =========================================================
        */
        $('.olivo-site-wrap').on("click touchstart", function(){
            if ( $("body").hasClass('olivo-sidebar-open') ) {
                $("body").removeClass('olivo-sidebar-open');  
            }
        });
        $('#olivo-sidebar-btn').on("click touchstart", function(event){
            event.stopPropagation();
            event.preventDefault();
            $("body").toggleClass('olivo-sidebar-open');
            $("#ql_nav_collapse").removeClass('in');
        });
        $(".sidebar-wrap").niceScroll({
            horizrailenabled: false,
            cursorborder: 'none',
            cursorcolor: "#fff",
            cursoropacitymax: 0.7,
            railpadding: { right: 20, top: 55 }
        });






        /*
        Portfolio Masonry
        =========================================================
        */
        $container_isotope = $('.portfolio-container');

        //Isotope parameters
        args_isotope = {
            itemSelector: '.portfolio-item',
            layoutMode: 'packery',
            percentPosition: true,
            transitionDuration: 400
        };


        
        //Wait to images load
        $container_isotope.imagesLoaded({
            background: true
        }, function($images, $proper, $broken) {

            //Load Color Preloader
            $container_isotope.find(".portfolio-item").each(function(index, el) {
                var $portfolio_item = $(this);
                var sourceImage = $portfolio_item.find('img').get(0);

                if (sourceImage) {
                    try {
                        var colorThief = new ColorThief();
                        var color_image = colorThief.getColor(sourceImage);

                        $portfolio_item.find('.portfolio-item-hover-preload').css('background-color', 'rgb(' + color_image[0] + ',' + color_image[1] + ',' + color_image[2] + ')');
                         $portfolio_item.find('.portfolio-item-hover').css('background-color', 'rgb(' + color_image[0] + ',' + color_image[1] + ',' + color_image[2] + ')');
                        setTimeout(function(){ $portfolio_item.addClass('loaded');}, ( 1000 + ( 70 * index ) ) );
                    }
                    catch(err) {
                        console.log(err);
                        $( "body canvas" ).last().remove();
                    }
                }
            });
            setTimeout(function(){ $container_isotope.find(".portfolio-item").removeClass('olivo-firstload');}, 3500);

            if ($container_isotope.hasClass('masonry')) {
                //Start Isotope
                $container_isotope.isotope(args_isotope);
                $(".ql_filter .ql_filter_count .total").text($container_isotope.isotope('getItemElements').length);
            };

            //Remove preloader
            $container_isotope.find('.preloader').addClass('proloader_hide');

            // filter items when filter link is clicked
            $('.filter_list a').click(function() {
                var selector = $(this).attr('data-filter');
                $container_isotope.isotope({
                    filter: selector
                });
                var $parent = $(this).parents(".filter_list");
                $parent.find(".active").removeClass('active');
                $(".filter_list").not($parent).find("li").removeClass('active').first().addClass("active");
                $(this).parent().addClass("active");
                return false;
            });

        }); //images loaded





        /*
        AJAX Portfolio Load More
        =========================================================
        */
        $('body').on('click', '.portfolio-load-more:not(.dribbble-load-more):not(.instagram-load-more)', function(event) {
            event.preventDefault();

            var $this = $(this);
            $this.addClass('loading_items');
            var category = $('.ql_filter .active a').attr('data-category');
            if (category) {
            }else{
                category = 'all';
            }
            var post_type = $('.portfolio-container').attr('data-post-type');
            var offset = $container_isotope.isotope('getItemElements').length;

            var portfolio_type = 'masonry';
            if( $('.portfolio-container').hasClass('portfolio-thirds') ){
                portfolio_type = 'thirds';
            }

            $.ajax({
            	url: olivo_lite.admin_ajax,
            	type: 'POST',
            	dataType: 'html',
            	data: {
            		action: 'olivo_lite_load_portfolio_items',
            		token: olivo_lite.token,
            		category: category,
                    post_type: post_type,
                    portfolio_type: portfolio_type,
            		offset: offset
            	},
            })
            .done(function(data) {
            	if ( data.length > 0 ) {
            		// create new item elements
            		var $items = $(data);

            		// $items.addClass('product_added');
              //       $items.addClass('loaded');
                    //$items.removeClass('olivo-firstload');
            		// Insert items to grid
            		$container_isotope.isotope( 'insert', $items );



            		// layout Isotope after each image loads
            		$container_isotope.imagesLoaded().progress( function() {
                        
                        //Load Color Preloader
                        $container_isotope.find(".portfolio-item").each(function(index, el) {
                            var $portfolio_item = $(this);
                            var sourceImage = $portfolio_item.find('img').get(0);
                            if (sourceImage) {
                                try {
                                    var colorThief = new ColorThief();
                                    var color_image = colorThief.getColor(sourceImage);

                                    $portfolio_item.find('.portfolio-item-hover-preload').css('background-color', 'rgb(' + color_image[0] + ',' + color_image[1] + ',' + color_image[2] + ')');
                                     $portfolio_item.find('.portfolio-item-hover').css('background-color', 'rgb(' + color_image[0] + ',' + color_image[1] + ',' + color_image[2] + ')');
                                    setTimeout(function(){ $portfolio_item.addClass('loaded');}, ( 200 ) );
                                }
                                catch(err) {
                                    //console.log(err);
                                    $( "body canvas" ).last().remove();
                                }
                            }
                        });

            			$container_isotope.isotope('layout');
                        setTimeout(function(){ $container_isotope.find(".portfolio-item").removeClass('olivo-firstload');}, 3500);

                        $container_isotope.on( 'layoutComplete',
                          function( event, laidOutItems ) {
                            console.log( 'Isotope layout completed on ' +
                              laidOutItems.length + ' items' );
                          }
                        );

            		});


            		$this.removeClass('loading_items');

            	}else{
            		$('.portfolio-load-more').hide();
                    $this.removeClass('loading_items');
            	}

            })
            .fail(function() {
                console.log('Fail');
            });
        });


        /*
        // Gallery Masonry
        //===========================================================
        */
        //Call Lightbox
        initPhotoSwipe('.gallery-masonry', 'a');

        /*
        // Gallery Thirds
        //===========================================================
        */
        //Call Lightbox
        initPhotoSwipe('.gallery-thirds', 'a');



        $(".ql_scroll_top").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });

        $('.dropdown-toggle').dropdown();
        $('*[data-toggle="tooltip"]').tooltip();

    });

} )( jQuery );


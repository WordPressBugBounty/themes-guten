/**
 * Guten Custom JS Functionality
 *
 */
( function( $ ) {
    
    jQuery( document ).ready( function() {
        
        // Handle clicking the purchase button
        $( 'a#upgrade-purchase-link-a' ).click( function(e) {
            e.preventDefault();
            window.open( $(this).attr( 'href' ), '_blank', 'width=960,height=800,resizeable,scrollbars' );
            return false;
        });
        
    });
    
    $(window).resize(function () {
        
        
        
    }).resize();
    
    $(window).on('load',function () {
        
        guten_upgrade_ratings_slider();
        
    });
    
    // Upgrade Ratings Slider
    function guten_upgrade_ratings_slider() {
        $( '.upgrade-rating-slider' ).carouFredSel({
            responsive: true,
            circular: true,
            infinite: false,
            width: 280,
            height: 'variable',
            items: {
                visible: 1,
                width: 280,
                height: 'variable'
            },
            onCreate: function(items) {
                $( '.upgrade-rating-slider-wrap' ).removeClass( 'upgrade-rating-slider-wrap-remove' );
            },
            scroll: {
                fx: 'crossfade',
                duration: 500
            },
            auto: 12000,
            prev: '.upgrade-rating-slider-prev',
            next: '.upgrade-rating-slider-next'
        });
    }
    
} )( jQuery );
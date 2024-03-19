// my scripts
jQuery(document).ready(function($) {
    // Create cookie
    function createCookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    // Read cookie
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Delete cookie
    function eraseCookie(name) {
        createCookie(name, "", -1);
    }

    // Create available dates for shipping in calendar
    // Set todays date
    var today = new Date();

    // Create date variable to set first available day for shipping
    var day_after_tomorrow = new Date(today);

    // Make Saturday, Sunday and Monday disabled
    var disabledDays = [6, 0];

    // Set first available shipping day no less then 2 days after order
    // or if today is Friday, next available date is next Tuesday
    if(day_after_tomorrow.getDay() == 5) {
        day_after_tomorrow.setDate(day_after_tomorrow.getDate() + 5);
    } else if(day_after_tomorrow.getDay() == 6) {
        day_after_tomorrow.setDate(day_after_tomorrow.getDate() + 4);
    } else {
        day_after_tomorrow.setDate(day_after_tomorrow.getDate() + 3);
    }

    var disabled_particular_days = [];

    // Initialize datepicker
    $('#delivery-date').datepicker({
        language: 'en',
        dateFormat: 'dd/mm/yyyy',
        firstDay: 1,
        minDate: day_after_tomorrow,
        onRenderCell: function (date, cellType) {
            var pretty_date = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();

            if (cellType == 'day') {
                var day = date.getDay();
                var isDisabled = disabled_particular_days.indexOf(pretty_date) != -1 || disabledDays.indexOf(day) != -1
    
                return {
                    disabled: isDisabled
                }
            }
        },
        onSelect: function(formattedDate, date, inst) {
            // Cookies
            eraseCookie('delivery_date');
            createCookie('delivery_date', formattedDate, 1);

            // Disable checkout link if delivery date is not selected
            if($('#delivery-date').val() == '') {
                $('.wc-proceed-to-checkout .wc-forward').addClass('link-is-disabled');
                console.log('Hide');
            } else {
                $('.wc-proceed-to-checkout .wc-forward').removeClass('link-is-disabled');
                console.log('Show');
            }
        }
    })

    // Disable checkout link if delivery date is not selected
    if(readCookie('delivery_date') == '') {
        $('.wc-proceed-to-checkout .wc-forward').addClass('link-is-disabled');
    } else {
        $('.wc-proceed-to-checkout .wc-forward').removeClass('link-is-disabled');
    }

    if(readCookie('delivery_date') != 'Delivery within 3-4 business days') {
        $('#delivery-option-standard').hide();
        $('#delivery-option-calendar').show();
        $('#delivery-standard').prop('checked', false);
        $('#delivery-calendar').prop('checked', true);
    }

    // Set delivery date from cookie
    $('#delivery-date, #delivery_date').val(readCookie('delivery_date'));
    $('#delivery_date_field label span.optional').html(readCookie('delivery_date'));
    $('.delivery-date-cell').html(readCookie('delivery_date'));

    $('form.checkout').on( 'change', function() { 
        $('.delivery-date-cell').html(readCookie('delivery_date'));
    });

    // Delivery method selection box
    $('#delivery-details .uk-radio').on('click', function (e) {
        if(e.currentTarget.dataset.element == 'delivery-option-calendar') {
            $('#delivery-option-standard').hide();
            $('#delivery-option-calendar').show();
            $('.wc-proceed-to-checkout .wc-forward').addClass('link-is-disabled');
            $('#delivery-date').val('');
        } else {
            $('#delivery-option-standard').show();
            $('#delivery-option-calendar').hide();
            $('.wc-proceed-to-checkout .wc-forward').removeClass('link-is-disabled');

            // Cookies
            eraseCookie('delivery_date');
            createCookie('delivery_date', 'Delivery within 3-4 business days', 1);
        }
    })

    // Match height for elements
    $('.product-box-inner').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    });
	
    $(document).on('click', '#button', function() {
        $(this).text(function(i, text){
            return text === "Recipe Suggestion" ? "Close" : "Recipe Suggestion";
        })
        $('#recipe-wrapper').slideToggle('slow');
    })

    // Select2 initialization
    $('select').select2({
        minimumResultsForSearch: Infinity
    });
    
    $('.dropdown_product_cat').change(function(){
        if( $(this).val() !=='' ) {
            location.href = 'object_name.templateUrl/?product_cat='+$(this).val();
        }
    });

    // Reveal Order Review and Payment Methods elements
    $(document).on('click', '.drop-open', function() {
        $('.uk-drop').removeClass('uk-hidden');
    })
	
	// Reveal Order Review and Payment Methods elements
    $(document).on('click', '#proceed-to-payment', function() {
        $('#payment-wrapper').removeClass('uk-hidden');
    })
    
    // Change Delivery Instruction text
    $('.woocommerce-checkout .shipping.dpd_uk-shipping th').html('Delivery Instructions and preferred delivery date');
	
	// Reveal Order Review and Payment Methods elements
    $(document).on('click', '#proceed-to-payment', function() {
        $('#payment-wrapper').removeClass('uk-hidden');
        
        setTimeout(function() {
            // Change Delivery Instruction text
            $('.woocommerce-checkout .shipping.dpd_uk-shipping th').html('Delivery Instructions and preferred delivery date');
        }, 1000);
        
    })
	
    // Remove cart item in mini cart
    $('.cart-basket .remove-item').click(function(e) {
        e.preventDefault();

        // Load preloader
        $('.cart-overlay').removeClass('uk-hidden');

        var clicked = $(this);

        // Ajax call
        $.ajax({
            type: "POST",
            url: loadmore_params.ajaxurl,
            data: {
                'action'        : 'remove_item_from_minicart', 
                'cart_item_key' : String($(this).data('cart-item-key'))
            },
            success: function (response) {
                if (response) {
                    clicked.parent().closest('.minicart-item').remove();

                    // Update cart total
                    var cache = $('#minicart-totals bdi').children();
                    $('#minicart-totals bdi').text(response).prepend(cache);

                    // Ajax call for shipping limit update
                    $.ajax({
                        type: "POST",
                        url: loadmore_params.ajaxurl,
                        data: {
                            action    : 'ims_free_shipping_cart_notice',
                            'is_ajax' : true
                        },
                        success: function (message) {
                            // Update shipping limit
                            var cache = $('.cart-message span.shipping-limit bdi').children();
                            $('.cart-message span.shipping-limit bdi').text(message).prepend(cache);

                            // Remove preloader
                            $('.cart-overlay').addClass('uk-hidden');
                        }
                    });

                    // Remove preloader
                    $('.cart-overlay').addClass('uk-hidden');
                }
            }
        });
    });

    // Change item quantity in mini cart
    $(document).on('change', '.minicart-item-qty input, .product-quantity input', function(e) {
        e.preventDefault();

        // Updated element
        var element = $(this);

        // Updated element parent
        var element_parent = $(this).parents().eq(2);

        // Update minicart
        ims_update_cart(element, element_parent);
    });

    // Change item variation quantity for add to cart button
    $(document).on('change', '.qty', function() {
        // Get button values
        var qty_value = $(this).val();
        var add_to_cart_url = $(this).parents().eq(3).find('a').attr('href');

        // Create new url for the button
        var url = removeParams('quantity', add_to_cart_url) + '&quantity=' + qty_value;

        // Apply new button url
        $(this).parents().eq(3).find('a').attr('href', url);
    });
});

// Function to update minicart
function ims_update_cart(element, element_parent) {
    // Load preloader
    $('.cart-overlay').removeClass('uk-hidden');

    var cart_item_key   = element.closest(element_parent).data('cart-item-key');
    var new_qty         = element.val();
    var minicart_item   = element.closest('.minicart-item');

    // Ajax call for cart update
    $.ajax({
        type: "POST",
        url: loadmore_params.ajaxurl,
        data: {
            'action'        : 'update_item_qty_in_minicart', 
            'cart_item_key' : String(cart_item_key),
            'qty'           : new_qty
        },
        success: function (response) {
            if (response) {
                console.log('Cart qty updated, new quantity: ' + new_qty);

                // Update cart total
                var cache = $('#minicart-totals bdi').children();
                $('#minicart-totals bdi').text(response).prepend(cache);

                // Change minicart total count
                change_minicart_total_count();

                // Ajax call for shipping limit update
                $.ajax({
                    type: "POST",
                    url: loadmore_params.ajaxurl,
                    data: {
                        'action'  : 'ims_free_shipping_cart_notice',
                        'is_ajax' : true
                    },
                    success: function (message) {
                        // Update shipping limit
                        $('.shipping-cart-notice').html(message);
                    }
                });

                // Update all qty input fields (cart and minicart)
                $('[name="' + cart_item_key + '"]').val(new_qty);

                // Update cart
                $('[name="update_cart"]').prop('disabled', false);
                $('[name="update_cart"]').trigger('click');

                // Remove element if qty is 0
                if(new_qty == 0 && minicart_item) {
                    minicart_item.closest('.minicart-item').remove();
                }

                // Remove preloader
                $('.cart-overlay').addClass('uk-hidden');
            }
        }
    });
}

// Change minicart total count
function change_minicart_total_count() {
    // Ajax call
    $.ajax({
        type: "POST",
        url: loadmore_params.ajaxurl,
        data: {
            'action'        : 'change_minicart_total_count'
        },
        success: function (response) {
            if (response) {
                $('.minicart-total-count').html(response);
            }
        }
    });
}

// Function for removing parameters from url
function removeParams(url_parameter, add_to_cart_url) {
    // Get url without parameters
    // var url = window.location.href.split('?')[0] + '?';
    var url = '';

    // Get url parameters
    var page_url = decodeURIComponent(add_to_cart_url),
        url_parameters = page_url.split('&'),
        url_parameter_name,
        i;
    
    for (i = 0; i < url_parameters.length; i++) {
        url_parameter_name = url_parameters[i].split('=');

        if (url_parameter_name[0] != url_parameter) {
            url = url + url_parameter_name[0] + '=' + url_parameter_name[1] + '&'
        }
    }

    return url.substring(0, url.length - 1);
}

var cdFn = {
    onReady: function($){
        if($('.woocommerce-cart').length){
            $('#delivery-standard').attr('checked', true);
        }
    }
};

jQuery(cdFn.onReady(jQuery));
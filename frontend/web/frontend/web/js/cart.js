var shipping_type_id, payment_type_id;
var item;

var ga_loaded = false;
//var ga_loaded = false; ga(function() { ga_loaded = true;}); //Check if Google Analytics is loaded
var step_id, promocode;
var paysera = 0;
var shipping_selected = 0;
var img_dir = '/css/img/';
var bank_dir = 'https://bank.paysera.com/assets/image/payment_types/';
var contact_img = [img_dir+'order_person.png',img_dir+'order_email.png',img_dir+'order_phone.png'];
var address_img = [img_dir+'order_address.png',img_dir+'order_city.png',img_dir+'order_address.png',img_dir+'order_city.png'];
var shipping_img = [img_dir+'kurjeris.jpg',img_dir+'terminalas.jpg',img_dir+'pastas.jpg'];
var payment_img = [img_dir+'paysera_small.jpg',img_dir+'cash_small.jpg',img_dir+'card_small.jpg'];
var bank_img = [bank_dir +'hanza.png', bank_dir +'vb2.png', bank_dir +'nord.png', bank_dir +'sb.png', bank_dir +'mb.png', bank_dir +'lku.png', bank_dir +'sampo.png', bank_dir +'parex.png', bank_dir +'nordealt.png', bank_dir +'wallet.png'];
var shipping_type;
var shipping_name;
var shipping_city;
var shipping_address;
var payment_type;
var customer_name;
var customer_email;
var customer_phone;
var item_names = [];
var item_ids = [];
var item_qnty = [];
var item_price = [];
var item_subtotal = [];
var item_images = [];
var item_categories = [];
var terminals = [
['Gedimino pr. 7 (Centrinis paštas)','Liepkalnio g. 112 (Maxima XX)','Ozo g. 25 (Akropolis)','P. Lukšio g. 34 (Banginis)','Ukmergės g. 282 (Maxima XXX)','Architektų g. 43 (IKI Papartis)','Bajorų kelias 4 (IKI Visoriai)','Baltupio g. 10 (Statoil)','Fabijoniškių g. 2A (IKI Fabijoniškės)','Geležinkelio g. 16 (Geležinkelio stotis)','J. Jasinskio g. 16 (Verslo trikampis)','J. Tiškevičiaus g. 22 (Maxima XX)','Laisvės pr. 43C (Statoil)','Mindaugo g. 25 (IKI Mindaugo)','Naugarduko g. 84 (Maxima XX)','Nemenčinės pl. 2 (IKI Antakalnis)','Ozo g. 18 (Ozas)','Pilaitės pr. 31 (Maxima XX)','Saltoniškių g. 9 (Panorama)','Taikos g. 162A (Maxima XX)','Tuskulėnų g. 66 (Maxima XX)','Ukmergės g. 369 (BIG)','Žalgirio g. 105 (Maxima XX)','Žirmūnų g. 2 (IKI Minskas)'],['A. Juozapavičiaus pr. 84A (NORFA XXL)','Islandijos pl. 32 (MEGA)','Karaliaus Mindaugo pr. 49 (Akropolis)','Pramonės pr. 6 / Draugystės g. 8 (Banginis)','Raudondvario pl. 284A (Maxima XX)','Savanorių pr. 255 (Maxima XXX)','Veiverių g. 150B (Maxima Bazė)','Jonavos g. 3 (IKI Lituanica)','K. Baršausko g. 57 (Statoil)','K. Baršausko g. 66A (Molas)','K. Petrausko g. 6 (Express Market)','K. Škirpos g. 17 (Šilas)','Pramonės pr. 29 (Maxima XXX)','Raudondvario pl. 94B (Rimi)','Šarkuvos g. 1A (Maxima XX)','V. Krėvės pr. 14B (Maxima XX)','V. Krėvės pr. 97 (IKI Saulėtekis)','Žemaičių pl. 19 (Statoil)'],['Liepojos g. 10 (Maxima XX)','Šilutės pl. 35 (Banginis)','Taikos pr. 61 (Akropolis)','H. Manto g. 11 (Maxima X)','Liepojos g. 238 (IKI Tauralaukis)','Nidos g. 5 (IKI Naikupė)','Sausio 15-osios g. 1A / 2A (Statoil)','Taikos pr. 115 (IKI Žardė)','Taikos pr. 139 (BIG)'],['Aido g. 8 (Akropolis)','Tilžės g. 225 (Norfa XL (PC Tilžė))','Dubijos g. 20A (Statoil)','Gardino g. 2 (IKI Dainai)'],['Klaipėdos g. 92 (Maxima XX)','Respublikos g. 71 (Maxima XX)','Klaipėdos g. 143A (Babilonas)','Ukmergės g. 18 (IKI Basanavičiaus)'],['Naujoji g. 90 (Maxima XX)','Santaikos g. 34G (Maxima XX)'],['Žiburio g. 12 (NORFA XL)'],['Vabalninko g. 8a (Maxima X)'],['Molėtų g. 13 (IKI Riešė)'],['M. K. Čiurlionio g. 50 (Aidas)'],['Rungos g. 4 (Maxima XX)'],['Klaipėdos g. 37 (Maxima XX)'],['Vytauto g. 67 (IKI Garliava)'],['Taikos g. 11 (Maxima XX)'],['Chemikų g. 2 (NORFA XL)'],['Upytės g. 19 (Maxima X)'],['Algirdo g. 1A (Maxima X)'],['Gedimino g. 110 (Maxima X)'],['J. Basanavičiaus g. 53 (Maxima XX)'],['S. Šilingo g. 5 (NORFA XL)'],['Žemaitės al. 29 (Maxima XX)'],['Gedimino g. 53N (Maxima XX)'],['Vilniaus g. 2 (Norfa)'],['Seinų g. 1 (Viešoji biblioteka)'],['Sporto g. 16 (Maxima X)','V. Kudirkos g. 3 (Maxima XXX)'],['Laisvės g. 56 (Maxima XX)','Žemaitijos g. 20 (Maxima XX)'],['V. Kudirkos g. 18 (Maxima XX)'],['Plytų g. 9a (Maxima X)'],['Vilniaus g. 48 (Maxima X)'],['J.Tumo-Vaižganto g. 81 (Maxima XX)'],['Vytauto g. 17 (Maxima X)'],['Gedimino g. 42A (Maxima XX)'],['Vilniaus g. 93 (Maxima XX)'],['Respublikos g. 111B (Maxima XX)'],['V. Kudirkos g. 66 (Maxima X)'],['S. Dariaus ir S. Girėno g. 12 (Maxima X)'],['Lietuvininkų g. 39 (IKI)'],['Bernotiškės g. 3 (NORFA XL)'],['Turgaus a. 15A (Swedbank)'],['Žiedo g. 1 (Maxima XX)'],['Aušros g. 78 (Maxima XX)'],['Savanorių g. 5 (Maxima X)'],['J. Basanavičiaus a. 1 (Maxima XX)'],['Taikos g. 66 (Maxima X)'],['D. Bukonto g. 7 (Maxima X)']
];

var url = window.location.href;
if (url.split('#')[1] !== undefined) {
    if(url.split('#')[1] == 'success'){
        document.title = 'Jūsų užsakymas sėkmingai pateiktas';
        none('#step0');
        block('#success_block');
        success_animate(600);
    } else if(url.split('#')[1] == 'cancel'){
        document.title = 'Jūsų užsakymas buvo atšauktas';
        none('#step0');
        block('#cancel_block');
    } else {
        window.location.replace(url.split('#')[0]);
    }
}

$(window).on('popstate', function() {
    $('.shopping_cart_steps').each(function () {
        if ($(this).css('display') == 'block') {
            $(this).find('.cart_back').click();
        }
    });
});

$('.shipping_addition_info input').keyup(function(){ autoAddress(this) });

function autoAddress(that){
    shipping_type = $(that).closest('.shipping_addition_info').data('addresstype');
    if(shipping_type == 1){
        var input_name = $('.not_selected .shipping_addition_info input[name="'+$(that).attr('name')+'"]');
        var input_value = $(that).val();
        input_name.val('');
        input_name.val(input_value);
    }
}

$('.cs_shipping_option').click(function(){
    var hidden_payment = $(this).data('hiddenpayment');
    var error_element = '.cs_shipping_option.selected .shipping_addition_info span';
    $(error_element).text('');
    nones([error_element,'.no_shipping_selected']);
    block('.cs_payment_option');
    block('.cs_payment_option .payment_info');
    $('.cs_payment_option').removeClass('selected');
    if(hidden_payment.length == 2) {
        $('.cs_payment_option').addClass('selected');
    }
    $('.cs_payment_option').each(function(index){
        for(i = 0; i < hidden_payment.length; i++){
            if(index == hidden_payment[i]) {
                none(this);
                $(this).removeClass('selected');
            }
        }
    });
    $('.cs_shipping_option').removeClass('selected');
    $('.cs_shipping_option').addClass('not_selected');
    $(this).addClass('selected');
    $(this).removeClass('not_selected');
    $('.cs_shipping_option').each(function () {
        if ($(this).hasClass('selected') && $(this).find('.shipping_info').css('display') == 'none') {
            $(this).find('.shipping_info').toggle('fast');
        } else if (!$(this).hasClass('selected') && $(this).find('.shipping_info').css('display') == 'block') {
            $(this).find('.shipping_info').toggle('fast');
        }
        if(shipping_selected == 0) {
            if ($(this).hasClass('selected') && $(this).find('.shipping_addition_info').css('display') == 'none') {
                $(this).find('.shipping_addition_info').toggle('fast');
            } else if (!$(this).hasClass('selected') && $(this).find('.shipping_addition_info').css('display') == 'block') {
                $(this).find('.shipping_addition_info').toggle('fast');
            }
            shipping_selected++;
            block('.cs_shipping_option .shipping_addition_info');
        }
    });
});

$('.cs_payment_option').click(function(){
    none('.no_payment_selected');
    $('.cs_payment_option').removeClass('selected');
    $(this).addClass('selected');
    $('.cs_payment_option').each(function () {
        if ($(this).hasClass('selected') && $(this).find('.payment_info').css('display') == 'none') {
            $(this).find('.payment_info').toggle('fast');
        } else if (!$(this).hasClass('selected') && $(this).find('.payment_info').css('display') == 'block') {
            $(this).find('.payment_info').toggle('fast');
        }
    });
});

function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    loc = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    var lastPath = window.location.href.substring(loc.length, window.location.href.length);
    return '/'+lastPath;
}

var pageTitle = ['Asmeninė informacija','Pristatymo adresas', 'Apmokėjimo būdas', 'Užsakymo patvirtinimas'];

function urlChange(stepId) {
    step_url = url+'#step'+stepId;
    if (stepId == 0) {
        window.history.pushState('obj', 'newtitle', window.location.href.split('#')[0]);
        document.title = 'Krepšelis';
    } else {
        window.history.pushState('obj', 'newtitle', step_url);
        document.title = 'Krepšelis - '+pageTitle[stepId-1];
    }
}

function next_step(that){
    step_id = $(that).closest('.shopping_cart_steps').attr('id').slice(-1);
    step_id = parseInt(step_id);
    var next_step = step_id+1;
    next_step = next_step.toString();
    none('#step'+step_id);
    $('#step'+next_step).fadeIn('fast');
    $('.top_step').removeClass('selected');
    $('.top_step:eq('+step_id+')').addClass('selected');
    if ($(window).width() < 501) {
        $("html, body").scrollTop(230);
    } else {
        $("html, body").scrollTop(250);
    }
    urlChange(next_step);
    if (ga_loaded) {
        ga('send', 'pageview', {'page' : getAbsolutePath()});
    }
}

function back_step(that){
    step_id = $(that).closest('.shopping_cart_steps').attr('id').slice(-1);
    step_id = parseInt(step_id);
    var back_step = step_id-1;
    if (back_step == 0) {
        none('.top_steps');
    }
    none('#step'+step_id);
    $('#step'+back_step).fadeIn('fast');
    $('.top_step').removeClass('selected');
    $('.top_step:eq('+(back_step-1)+')').addClass('selected');
    if ($(window).width() < 501) {
        $("html, body").scrollTop(230);
    } else {
        $("html, body").scrollTop(250);
    }
    urlChange(back_step);
    if (ga_loaded) {
        ga('send', 'pageview', {'page' : getAbsolutePath()});
    }
}

$('.cart_back').click(function () {
    back_step(this);
});

$('#step0 .button').click(function(){
    block('.top_steps');
    $('#step1 div label').each(function(index){
        $(this).css('background-image','url('+contact_img[index]+')');
    });
    item_names = [];
    item_ids = [];
    item_qnty = [];
    item_price = [];
    item_subtotal = [];
    item_images = [];
    item_categories = [];
    var names = $('.itemRow .item-name').toArray().reverse();
    var prices = $('.itemRow .item-price').toArray().reverse();
    //var qtys = $('.itemRow .item-quantity').toArray().reverse();
    var qtys = $('.itemRow').find('.item-quantity').toArray().reverse();
    var subtotals = $('.itemRow .item-total').toArray().reverse();
    var productids = $('.itemRow .item-productshopid').toArray().reverse();
    var images = $('.itemRow .item-productimg').toArray().reverse();
    var categories = $('.itemRow .item-category').toArray().reverse();
    for (var t = (names.length-1); t >= 0; t--) {
        item_names.push(names[t].innerHTML);
        item_price.push(prices[t].innerHTML);
        //item_qnty.push(qtys[t].innerHTML);
        item_qnty.push(qtys[t].value);
        item_subtotal.push(subtotals[t].innerHTML);
        item_ids.push(productids[t].innerHTML);
        item_images.push(images[t].innerHTML);
        item_categories.push(categories[t].innerHTML);
    }
    next_step(this);
});

$('#step1 .button').click(function(){
    var name = $('#step1 #order_name').val();
    var email = $('#step1 #order_email').val();
    var phone = $('#step1 #order_phone').val();
    var input_errors = [];
    if(name.length < 1) {
        input_errors.push(0);
    }
    if(!validateEmail(email)){
        input_errors.push(1);
    }
    if (phone.length === 0 || phone.length < 12) {
        input_errors.push(2);
    }

    if(input_errors.length > 0){
        $('#step1 .ssc_input_error').each(function(index){
            for(i = 0; i < input_errors.length; i++) {
                if(index == input_errors[i] && $(this).css('display') == 'none') {
                    $(this).toggle('fast');
                }
                $('#step1 .ssc_input').eq(input_errors[i]).css('border-color','#f99');
            }
        });
        return false;
    }
    customer_name = name;
    customer_phone = phone;
    customer_email = email;
    $('.cs_shipping_option .shipping_img').each(function(index){
        $(this).html('<img src="'+shipping_img[index]+'">');
        $(this).find("img").fadeIn('medium');
    });
    $('.shipping_addition_info label').each(function(index){
        $(this).css('background-image','url('+address_img[index]+')');
    });
    next_step(this);
});

$('#step2 .button').click(function(){
    var shipping_err_text = 'Įveskite pristatymo adresą';
    shipping_type = $('.cs_shipping_option.selected .shipping_addition_info').data('addresstype');

    if(typeof shipping_type == 'undefined' || shipping_type == ''){
        $('.no_shipping_selected').text('Pasirinkite pristatymo būdą');
        $('.no_shipping_selected').fadeIn('fast');
        $('.no_shipping_selected').css('display','inline-block');
        return false;
    }

    shipping_type_code = $('.cs_shipping_option.selected').data('shippingtype').toUpperCase();
    if  ( (typeof shippingTypeList === 'undefined') ||  (typeof shippingTypeList[shipping_type_code] === 'undefined') ) {
        shipping_type_id = null;
    } else {
        shipping_type_id = shippingTypeList[shipping_type_code];
    }

    if(shipping_type == 1){
        shipping_address = $('.cs_shipping_option.selected .shipping_addition_info input[name="shipping_address"]').val();
        shipping_city = $('.cs_shipping_option.selected .shipping_addition_info input[name="shipping_city"]').val();
    }
    if(shipping_type == 2){
        shipping_address = $('.cs_shipping_option.selected .shipping_addition_info #terminal_id option:selected').val();
        shipping_city = $('.cs_shipping_option.selected .shipping_addition_info #terminal_city option:selected').val();
        shipping_err_text = 'Pasirinkite pristatymo terminalą';
    }
    if(shipping_address.length === 0 || shipping_city.length === 0){
        $('.cs_shipping_option.selected .shipping_addition_info span').fadeIn('fast');
        $('.cs_shipping_option.selected .shipping_addition_info span').css('display','inline-block');
        $('.cs_shipping_option.selected .shipping_addition_info span').text(shipping_err_text);
        return false;
    }
    shipping_name = $('.cs_shipping_option.selected').data('shipping');
    $('.cs_payment_option .payment_img').each(function(index){
        $(this).html('<img src="'+payment_img[index]+'">');
        $(this).find("img").fadeIn('medium');
    });
    next_step(this);
});

$('#step3 .button').click(function(){
    payment_type = $('.cs_payment_option.selected').data('payment');
    paysera = $('.cs_payment_option.selected').data('paysera');

    if(typeof payment_type == 'undefined' || payment_type == ''){
        $('.no_payment_selected').text('Pasirinkite apmokėjimo būdą');
        $('.no_payment_selected').fadeIn('fast');
        $('.no_payment_selected').css('display','inline-block');
        return false;
    }

    payment_type_code = $('.cs_payment_option.selected').data('paymentcode').toUpperCase();

    if  ( (typeof paymentTypeList === 'undefined') ||  (typeof paymentTypeList[payment_type_code] === 'undefined') ) {
        payment_type_id = null;
    } else {
        payment_type_id = paymentTypeList[payment_type_code];
    }

    $('ul.paysera-payment li').each(function(index){
        var alt_text = $(this).text();
        $(this).html('<img src="'+bank_img[index]+'" alt="'+alt_text+'">');
    });

    if (paysera == 1) {
        $('#confirm_order').text('Apmokėti užsakymą');
        block('.paysera-payment-block');
    } else {
        $('#confirm_order').text('Patvirtinti užsakymą');
        none('.paysera-payment-block');
    }
    $('.pr-sum').remove();
    for (i = 0; i < item_names.length; i++) {
        $('.product_summary').append('<div class="product_sum_row pr-sum pr-sum-'+i+'"></div>');
        $('.pr-sum-'+i).append('<div class="product_sum_name">'+'<img src="'+item_images[i]+'">'+item_names[i]+'</div>');
        $('.pr-sum-'+i).append('<div class="product_sum_qnty">'+item_qnty[i]+'</div>');
        $('.pr-sum-'+i).append('<div class="product_sum_price">'+item_price[i]+'</div>');
        $('.pr-sum-'+i).append('<div class="product_sum_sum">'+item_subtotal[i]+'</div>');
    }
    next_step(this);
});

$('#terminal_city').change(function(){
    var termina_city = $('#terminal_city').prop('selectedIndex');
    if(terminals[termina_city].length == 1){
        $('#terminal_id').html('');
    } else {
        $('#terminal_id').html('<option value="">-- Pasirinkite --</option>');
    }
    for (i = 0; i < terminals[termina_city].length; i++) {
        $('#terminal_id').append('<option value="'+terminals[termina_city][i]+'">'+terminals[termina_city][i]+'</option>');
    }
});

$('#mobile_bank_selcet').change(function(){
    var m_bank = $(this).val();
    if(m_bank !== ''){
        $('.paysera-payment li#'+m_bank).click();
    } else {
        $('.paysera-payment li').removeClass('selected');
        $('#paysera-form input[name="payment_bank"]').val('');
    }
});

$('.paysera-payment li').click(function(){
    $('.paysera-payment li').css('opacity','0.5');
    $('.paysera-payment li').removeClass('selected');
    $(this).addClass('selected');
    $(this).css('opacity','1');
    $('#paysera-form input[name="payment_bank"]').val($(this).attr('id'));
    none('.no_bank_selected');
});

//ORDER_SUCCESS START
$('#confirm_order').click(function(){
    if(paysera == 1) {
        var selected_bank = $('#paysera-form input[name="payment_bank"]').val();
        if(selected_bank.length == 0){
            $('.no_bank_selected').fadeIn('fast');
            $('.no_bank_selected').css('display','inline-block');
            return false;
        }
    }
    block('.cart_black_bg');
    Order = {
        "client_name": customer_name,
        "phone": customer_phone,
        "email": customer_email,
        "shipping_type_id": shipping_type_id,
        "payment_type_id": payment_type_id,
        "comment": $('#order_comment').val(),
        "promocode": promocode,
        "address": "Miestas: " + shipping_city + "; adresas: " + shipping_address,
        /*
        'delivery_time_date', 'delivery_time_hour',
        'delivery_time_min', 'delivery_type', ''
        */
        //"base_cost": simpleCart.grandTotal(),
        //"cost": ssc_total()
    };
    $.post(orderUrl,{
        Order: Order,
/*
        //Order details
        total: ssc_total(),
        product_total: simpleCart.total(),
        discount_total: discount_total,
        discount_name: $('.ssc_discount_input > input').val(),
        discount_type: discount_type,
        discount_value: discount,
        utm_source: '',
        utm_medium: '',
        utm_campaign: '',
        comment: $('#order_comment').val(),
        //Products
        item_names: item_names,
        item_price: item_price,
        item_qnty: item_qnty,
        item_subtotal: item_subtotal,
        item_ids: item_ids,
        item_images: item_images,
        //Shipping
        shipping_name: shipping_name,
        shipping_address: shipping_address,
        shipping_city: shipping_city,
        shipping_total: 0,
        shipping_tag: $('.cs_shipping_option.selected').data('shippingtype'),
        //Payment
        payment_tag: $('.cs_payment_option.selected').data('paymenttype'),
        payment_type: payment_type
*/
    },function(data){
        //console.log(data);
        var res = $.parseJSON( data );
        data = res.orderId;
        if (ga_loaded) {
            ga('require', 'ecommerce');
            ga('ecommerce:addTransaction', {
                'id': data,
                'affiliation': 'Tomeda',
                'revenue': ssc_total(),
                'shipping': 0,
                'tax': '0'
            });
            for (var p = 0; p < item_names.length; p++) {
                ga('ecommerce:addItem', {
                    'id': data,
                    'name': item_names[p],
                    'sku': item_ids[p],
                    'category': item_categories[p],
                    'price': item_price[p].slice(0, -1),
                    'quantity': item_qnty[p]
                });
            }
            ga('ecommerce:send');
            ga('ecommerce:clear');
        }
        if(paysera == 1) {
            $('#paysera-form input[name="order_id"]').val(data);
            setTimeout(function(){$('#paysera-form').submit();},500);
            return false;
        }
        window.history.pushState('obj', 'newtitle', url+'#success');
        document.title = 'Jūsų užsakymas sėkmingai pateiktas';
        nones(['.top_steps', '.shopping_cart_steps', '.cart_black_bg']);
        $('#success_block').fadeIn('fast');
        if (ga_loaded) {
            ga('send', 'pageview', {'page' : getAbsolutePath()});
        }
        if ($(window).width() < 501) {
            $("html, body").scrollTop(230);
        } else {
            $("html, body").scrollTop(250);
        }
        truncateCart();
        success_animate(200);
    }).fail(function() {
        alert( "Kažkas nutiko, prašome perkrauti puslapį." );
    });
});
//ORDER_SUCCESS END

$('#step1 .ssc_input').keypress(function(){
    $(this).css('border-color','#ccc');
    $(this).next().css('display','none');
});

$('#step1 .ssc_input').click(function(){
    $(this).css('border-color','#ccc');
    $(this).next().css('display','none');
});

function success_animate(time) {
    /*
    var article_nubmer = $('.s-article').size();
    var article_arr;
    $.post('/app/cart/articles.php',{article_nubmer:article_nubmer},function (data) {
        article_arr = JSON.parse(data);
        for (i = 0; i < article_nubmer; i++) {
            $('.s-article').eq(i).find('a').attr("href", article_arr[i][0]);
            $('.s-article').eq(i).find('.s-article-img img').attr("src", article_arr[i][2]);
            $('.s-article').eq(i).find('.s-article-name').text(article_arr[i][1]);
        }
    });
    */
    setTimeout(function() {
        $('.s-bags').animate({opacity: 1,top: '0px'},1000);
        $('.s-check').animate({opacity: 1,top: '30px'},700,function () {
            $('.s-text').animate({opacity: 1},500,function () {
                success_bullets_animate();
            });
        });
    }, time);
}

var stop_success_bullets = 0;

function success_bullets_animate() {
    var bullets_size = $('.s-point').size();
    if (stop_success_bullets < bullets_size) {
        $('.s-point').eq(stop_success_bullets).animate({opacity: 1},500,function () {
            success_bullets_animate();
        });
    } else {
        stop_success_bullets = 0;
        success_articles_animate()
        return false;
    }
    stop_success_bullets++;
}

function success_articles_animate() {
    var bullets_size = $('.s-article').size();
    if (stop_success_bullets < bullets_size) {
        $('.s-article').eq(stop_success_bullets).animate({opacity: 1},200,function () {
            success_articles_animate();
        });
    }
    stop_success_bullets++;
}

function block(element){$(element).css('display','block');}

function none(element){$(element).css('display','none');}

function nones(element){
    for(i = 0; i < element.length; i++){
        $(element[i]).css('display','none');
    }
}

function pv() {if ($('.registerphone').val() == '') {$('.registerphone').val('+');}if ($('.registerphone').val() == '+3708') {$('.registerphone').val('');$('.registerphone').val('+370');}if ($('.registerphone').val().length > 12) {var num = $('.registerphone').val().slice(0,-1);$('.registerphone').val('');$('.registerphone').val(num);}var num = $('.registerphone').val();$('.registerphone').val('');$('.registerphone').val(num);}

$('.registerphone').keyup(pv);
$('.registerphone').keydown(pv);
$('.registerphone').keypress(function (e){if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {return false;}});
$('.registerphone').click(function () {var num = $('.registerphone').val();$('.registerphone').val('');$('.registerphone').val(num);});

function validateEmail(email) {var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
return re.test(email);}

var discount = 0;
var discount_type = 0;
var discount_total = 0;

simpleCart.currency({
    code: "EUR",
    symbol: "€",
    after: true,
    delimiter: "",
});

simpleCart({
    cartColumns: [
        { view: "image", attr:'thumb', label: false},
        { attr: "name" , label: "Pavadinimas" } ,
        { attr: "price" , label: "Kaina", view: 'currency' } ,
        { view: "decrement" , label: false , text: "&nbsp;" } ,
        { attr: "quantity" , label: "Kiekis" } ,
        { view: "increment" , label: false , text: "&nbsp;" } ,
        { attr: "total" , label: "Suma", view: 'currency' } ,
        { view: "remove" , text: "Pašalinti" , label: false },
        { attr: "productshopid", label: false },
        { attr: "productimg", label: false },
        { attr: "category", label: false }
    ]
});

function truncateCart() {
    simpleCart.empty();
    $('.dvizh-cart-informer').addClass('empty');
    $('.dvizh-cart-count').html('0');
}

simpleCart.bind( 'update' , function(){
    $('.pr-total-products').html('Jūsų krepšelyje viso yra <b>'+simpleCart.quantity()+' prekė(ės) – '+ssc_total().toFixed(2)+'€</b>');
    $('.ssc_cart_total .ssc_total_sum').html(simpleCart.total().toFixed(2)+'€');
    $('.ssc_cart_grand_total .ssc_total_sum').html(ssc_total().toFixed(2)+'€');
    if (simpleCart.quantity() > 0) {
        $('.ss_cart .ssc_total').css('display','block');
    } else {
        $('.ss_cart .ssc_total').css('display','none');
        $('.ss_cart .ssc_empty').css('display','block');
    }
    if(discount > 0) {
        var discount_text = parseFloat(discount).toFixed(2)+'€';
        if(discount_type == 1) {
            discount_text = simpleCart.grandTotal()*discount/100;
            discount_text = parseFloat(discount_text).toFixed(2)+'€';
        }
        $('.ssc_cart_discount').css('display','block');
        $('.ssc_cart_discount .ssc_total_sum').text('-'+discount_text);
    } else {
        discount = 0;
        var discount_text = parseFloat(discount).toFixed(2)+'€';
        $('.ssc_cart_discount .ssc_total_sum').text('-'+discount_text);
        $('.ssc_cart_discount').css('display','none');
    }
});


simpleCart.ready( function(){
    setTimeout(function(){$('#step0-button').fadeIn('fast');},1000);
});

if(window.location.href.split('#')[1] == 'success'){
    truncateCart();
}

simpleCart.bind( "beforeAdd" , function( item ){
    /*
    var fullUrl = item.get("thumb");
    var urlToArrays = fullUrl.split('.');
    var urlDotJPG = '.'+urlToArrays[urlToArrays.length-1];
    var urlRemoveSize = '500x500.'+urlToArrays[urlToArrays.length-1];
    urlToArrays = fullUrl.split(urlRemoveSize);
    item.set("thumb",urlToArrays[0]+'100x100'+urlDotJPG);
    item.set("productimg",urlToArrays[0]+'100x100'+urlDotJPG);
    */
});

function ssc_total() {
    var sc_total = simpleCart.grandTotal();
    var end_price;
    if(discount_type == 1) {
        discount_total = sc_total*discount/100;
        end_price = sc_total - discount_total;
    } else if (discount_type == 2) {
        discount_total = discount
        end_price = sc_total - discount;
        if(end_price < 0) {
            end_price = 0;
        }
    }
    if(discount_type == 0) {
        end_price = sc_total;
    }
    return end_price;
}

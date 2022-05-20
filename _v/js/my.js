//header scripts

//open nav

$(document).ready(function () {
    $('.js-open-nav').click(function () {
        $(this).toggleClass('is-active');
        $('.js-mobile').toggleClass('is-open');
        $('body').toggleClass('menu-open');
    });
});
//open nav end

//open submenu
$(document).ready(function () {
    $('.js-open-submenu').click(function () {
        $(this).parents('.menu-item').find('.js-submenu').slideToggle();
        $(this).parents('.menu-item').toggleClass('is-active');
        $(this).toggleClass('is-active');
    });
});
//open submenu  end

// header sticky
$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.js-header').addClass("is-sticky");
        $('.js-search-menu').addClass("is-sticky");
        $('.js-basket-menu').addClass("is-sticky");
        $('.js-panel').addClass("is-sticky");
    } else {
        $('.js-header').removeClass("is-sticky");
        $('.js-search-menu').removeClass("is-sticky");
        $('.js-basket-menu').removeClass("is-sticky");
        $('.js-panel').removeClass("is-sticky");
    }
});
// header sticky end


//open search sticky
$('.js-btn-search').click(function () {
    $('.js-open-search').toggleClass('is-open');
    $(this).removeClass('catalog-open');
    $('.js-menus').removeClass('is-open');
    $('.js-catalog-open').removeClass('is-active');
    $('.js-header__basket').removeClass('is-active');
});

//open search sticky end


//open catalog

$('.js-catalog-open').click(function () {
    $(this).toggleClass('is-active');
    $('.js-overlay').toggleClass('catalog-open');
    $('.js-menus').toggleClass('is-open');
    $('body').toggleClass('menu-open');
});

$('.js-overlay').click(function () {
    $(this).removeClass('catalog-open');
    $('.js-menus').removeClass('is-open');
    $('.js-catalog-open').removeClass('is-active');
    $('.js-header__basket').removeClass('is-active');
    $('body').removeClass('menu-open');
});
$('.js-catalog-close').click(function () {
    $('.js-overlay').removeClass('catalog-open');
    $('.js-menus').removeClass('is-open');
    $('.js-catalog-open').removeClass('is-active');
    $('body').removeClass('menu-open');
});


//open catalog end


//open header basket




jQuery(function ($) {
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".js-basket-menu__wrap"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.js-header__basket').removeClass('is-active');
            $('.js-header').removeClass('basket-open');
            $('.js-basket-menu').removeClass('is-open');
            $('body').removeClass('no-scroll');
        }
    });
});

//open header basket  end


//open search menu

$(document).ready(function () {
    $('.js-open-search').click(function () {
        $('.js-menus').removeClass('is-open');
        $('.js-catalog-open').removeClass('is-active');
        $('.js-header').addClass('search-open');
        $('.js-basket-menu').removeClass('is-open');
        $('.js-overlay').removeClass('catalog-open');
        $('.js-search-menu').addClass('is-active');
        $('body').addClass('open-search');
        $('body').removeClass('menu-open');
    });
});

jQuery(function ($) {
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".js-open-search, .js-search-menu__wrap"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.js-search-menu').removeClass('is-active');
            $('.js-header').removeClass('search-open');
            $('body').removeClass('open-search');
            $('.js-open-search').removeClass('is-open');
        }
    });
});

//open search menu end


//header scripts end


//open catalog filters desctop
$(document).ready(function () {
    $('.js-sidebar__header').click(function () {
        $(this).parent().find('.js-collapse').slideToggle();
        $(this).toggleClass('is-active');
    });
});
//open catalog filters desctop end


//open filters on desktop
$(document).ready(function () {
    $('.js-catalog-marks').click(function () {
        $(this).parents('.js-catalog__filter').find('.js-catalog__filters').addClass('is-open');
        $('body').addClass('filter-open');
        $('main').addClass('is-front');
    });
});

jQuery(function ($) {
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".js-catalog__inner"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $(this).find('.js-catalog__filters').removeClass('is-open');
            $('body').removeClass('filter-open');
            $('main').removeClass('is-front');
        }
    });
});

//open filters on desktop end

//open catalog list more
$(document).ready(function () {
    $('.js-open-list').click(function () {
        $(this).toggleClass('is-active');
        $(this).parents('.js-catalog-block__item').find('.js-catalog-block__list').slideToggle();
    });
});

$(document).ready(function () {
    $('.js-open-catalog-item').click(function () {
        $(this).parents('.catalog-block').find('.js-catalog-block__item').css('display', 'flex');
    });
});
//open catalog list more end


//card btns
$(document).ready(function () {
    $('.js-add-basket').click(function () {
        $(this).toggleClass('is-active');
    });
});
$(document).ready(function () {
    $('.js-add-favorite').click(function () {
        $(this).toggleClass('is-active');
    });
});


$(document).ready(function () {
    $('.js-card__delete').click(function () {
        $(this).parent('.js-card').hide();
        $(this).parents('.slick-slide').hide();
        $(this).parents('.col').hide();
    });
});
//card btns


//card change show
$(document).ready(function () {
    $('.js-show-table').click(function () {
        $(this).parents('.js-catalog__wrap').find('.js-card').addClass('table-show');
        $(this).addClass('is-active');
        $('.js-show-default').removeClass('is-active');
    });
});

$(document).ready(function () {
    $('.js-show-default').click(function () {
        $(this).parents('.js-catalog__wrap').find('.js-card').removeClass('table-show');
        $(this).addClass('is-active');
        $('.js-show-table').removeClass('is-active');
    });
});
//card change show end


//open mobile filters

$(document).ready(function () {
    $('.js-open-filter').click(function () {
        $('.js-filters').addClass('is-open');
        $('body').addClass('mobile-filter-open');
    });
});

//open mobile filters end

//close mobile filters
$(document).ready(function () {
    $('.js-filters__close').click(function () {
        $('.js-filters').removeClass('is-open');
        $('body').removeClass('mobile-filter-open');
    });
});

//close mobile filters end


//open filter in mobile filters
$(document).ready(function () {
    $('.js-filters__open').click(function () {
        $(this).parents('.js-filters__item').find('.js-filters__body').slideToggle();
        $(this).toggleClass('is-active');
    });
});
//open filter in mobile filters

//add product to favorite
$(document).ready(function () {
    $('.js-product-favorite').click(function () {
        $(this).toggleClass('is-active');
    });
});
//add product to favorite end

//add product to basket

$(document).ready(function () {
    $('.js-product__basket').click(function () {
        $(this).toggleClass('is-active');
    });
});
//add product to basket end


//delete product from basket
$(document).ready(function () {
    $('.js-product-delete').click(function () {
        $(this).parents('tr').hide();
    });

    $('.js-basket__clear').click(function () {
        $(this).parents('.basket').find('.basket-table').hide();
    });
});

//delete product from basket

//tel mask
document.querySelectorAll("input[type='tel']").forEach(function (el) {
    new Cleave(el, {
        blocks: [0, 1, 3, 3, 2, 2],
        delimiters: ['+ ', ' (', ') ', '-', '-', ' '],
        numericOnly: true
    });
});
//tel mask end


//bootstrap touchspin
$(".js-input-touchspin").TouchSpin({});
//bootstrap touchspin end

//form placeholder

$('.form-group').find('input,textarea').focusin(function () {
    $(this).parents(".form-group").find(".form-control-placeholder").addClass('is-hide');
});
$('.form-group').find('input,textarea').focusout(function () {
    $(this).parents(".form-group").find(".form-control-placeholder").removeClass('is-hide');
});

$('.form-group').find('input,textarea').change(function () {
    if ($(this).val()) {
        $(this).parents(".form-group").find(".form-control-placeholder").addClass('is-active');
    } else {
        $(this).parents(".form-group").find(".form-control-placeholder").removeClass('is-active');
    }
});

//form placeholder end


//bootstrap tabs on hover
if (document.getElementById('js-menus')) {
    (function ($) {
        $(function () {
            $(document).off('click.bs.tab.data-api', '[data-hover="tab"]');
            $(document).on('mouseenter.bs.tab.data-api', '[data-toggle="tab"],' +
                ' [data-hover="tab"]', function (e) {
                e.preventDefault()
                $(this).tab('show');
                $('.js-nav-pills-hidden').removeClass('is-visible');
                $(this).parents('li').find('.js-nav-pills-hidden').addClass('is-visible');
                $(this).parents('.nav-pills').find('li').removeClass('active');
                $(this).parents().addClass('active')
            });
        });
    })(jQuery);
}
//bootstrap tabs on hover end


// scroll
document.addEventListener("DOMContentLoaded", function () {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll(".js-menus__scroll"), {});
});

document.addEventListener("DOMContentLoaded", function () {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll(".js-basket-menu__scroll"), {});
});

document.addEventListener("DOMContentLoaded", function () {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll(".js-search-menu__scroll"), {});
});

document.addEventListener("DOMContentLoaded", function () {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll(".js-product__table_scroll"), {});
});

document.addEventListener("DOMContentLoaded", function () {
    //The first argument are the elements to which the plugin shall be initialized
    //The second argument has to be at least a empty object or a object with your desired options
    OverlayScrollbars(document.querySelectorAll(".js-order-scroll"), {});
});
// scroll end


//sliders
//slider homescreen
$('.js-homescreen__slider')
    .on('afterChange init', function (event, slick, direction) {
            slick.$slides.removeClass('prev-slide').removeClass('next-slide');

            // find current slide
            for (var i = 0; i < slick.$slides.length; i++) {
                var $slide = $(slick.$slides[i]);
                if ($slide.hasClass('slick-current')) {
                    // update DOM siblings
                    $slide.prev().addClass('prev-slide');
                    $slide.next().addClass('next-slide');
                    break;
                }
            }
        }
    )
    .on('beforeChange', function (event, slick) {
        slick.$slides.removeClass('prev-slide').removeClass('next-slide');
    })
    .slick({
        infinite: true,
        fade: true,
        autoplay: false,
        // autoplaySpeed: 3000,
        prevArrow: $('.js-homescreen__prev'),
        nextArrow: $('.js-homescreen__next'),
        dots: true,
    });


//slider homescreen end

//slider recommendation
$('.js-recommendation-block__slider').slick({
    infinite: true,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 4,
    prevArrow: $('.js-recommendation-block__prev'),
    nextArrow: $('.js-recommendation-block__next'),
    dots: false,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 992,
            settings: {
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1199,
            settings: {
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
    ],

})
//slider recommendation end


//slider sales

$('.js-sale-block__slider').slick({
    infinite: true,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 3,
    dots: false,
    mobileFirst: true,
    prevArrow: $('.js-sale-block__prev'),
    nextArrow: $('.js-sale-block__next'),
    responsive: [
        {
            breakpoint: 300,
            settings: {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 992,
            settings: {
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1199,
            settings: {
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
    ],
})
//slider sales end


//slider news
$('.js-news-block__slider').slick({
    infinite: true,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 2,
    prevArrow: $('.js-news-block__prev'),
    nextArrow: $('.js-news-block__next'),
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
            },
        },
        {
            breakpoint: 992,
            settings: {
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
})
//slider news end


//slider producers
$('.js-producers__slider').slick({
    infinite: true,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 7,
    mobileFirst: true,
    prevArrow: $('.js-producers__prev'),
    nextArrow: $('.js-producers__next'),
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 992,
            settings: {
                dots: false,
                slidesToShow: 5,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1199,
            settings: {
                dots: false,
                slidesToShow: 7,
                slidesToScroll: 1,
            },
        },
    ],

})
//slider producers end


//slider other sales
$('.js-others__slider').slick({
    infinite: true,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                mobileFirst: true,
                arrows: false,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
                mobileFirst: true,
                arrows: false,
            },
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                mobileFirst: true,
                arrows: false,
            },
        },
        {
            breakpoint: 1199,
            settings: "unslick",

        },
    ],
});
//slider other sales end


//slider reviews
$('.js-reviews__slider').slick({
    infinite: false,
    autoplay: false,
    // autoplaySpeed: 3000,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: $('.js-reviews__prev'),
    nextArrow: $('.js-reviews__next'),
    dots: false,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 992,
            settings: {
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1199,
            settings: {
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
    ],
});
//slider reviews end


//slider product
$('.js-product__slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    asNavFor: '.js-product__thumbs',
    dots: true,
});
$('.js-product__thumbs').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.js-product__slider',
    dots: false,
    focusOnSelect: true,
    prevArrow: $('.js-product__prev'),
    nextArrow: $('.js-product__next'),
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
            },
        },
        {
            breakpoint: 991,
            settings: {
                settings: "unslick",
            },
        },
        {
            breakpoint: 1199,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
            },
        },
    ],
});
//slider product

//sliders end


//nouislider


if (document.querySelector('#catalog-range')) {
    let inputNum1 = document.getElementById('input-number1');

    let html5Slider = document.getElementById('catalog-range');

    noUiSlider.create(html5Slider, {
        start: [1999, 3000],
        connect: true,
        behaviour: 'tap',
        range: {
            'min': 0,
            'max': 10000
        },
        format: wNumb({
            decimals: 0,
            thousand: '',
        })
    });

    let inputNum2 = document.getElementById('input-number2');

    html5Slider.noUiSlider.on('update', function (values, handle) {

        let value = values[handle];

        if (handle) {
            inputNum2.value = value;
        } else {
            inputNum1.value = Math.round(value);
        }
    });

    inputNum1.addEventListener('change', function () {
        html5Slider.noUiSlider.set([this.value, null]);
    });

    inputNum2.addEventListener('change', function () {
        html5Slider.noUiSlider.set([null, this.value]);
    });
}


if (document.querySelector('#catalog-range2')) {
    let inputNum1 = document.getElementById('input-number3');

    let html5Slider = document.getElementById('catalog-range2');

    noUiSlider.create(html5Slider, {
        start: [1999, 3000],
        connect: true,
        behaviour: 'tap',
        range: {
            'min': 0,
            'max': 10000
        },
        format: wNumb({
            decimals: 0,
            thousand: '',
        })
    });

    let inputNum2 = document.getElementById('input-number4');

    html5Slider.noUiSlider.on('update', function (values, handle) {

        let value = values[handle];

        if (handle) {
            inputNum2.value = value;
        } else {
            inputNum1.value = Math.round(value);
        }
    });

    inputNum1.addEventListener('change', function () {
        html5Slider.noUiSlider.set([this.value, null]);
    });

    inputNum2.addEventListener('change', function () {
        html5Slider.noUiSlider.set([null, this.value]);
    });
}


//change position text in product page

function openSearch() {
    if ($(window).width() < 992) {
        //при ширине окна менее 768px перемещаем фильтр в шапку
        $('.js-header__basket').click(function () {
            $('body').addClass('no-scroll');
            $('.js-menus').removeClass('is-open');
            $('.js-catalog-open').removeClass('is-active');
            $(this).addClass('is-active');
            $('.js-header').addClass('basket-open');
            $('.js-basket-menu').addClass('is-open');
            $('.js-overlay').removeClass('catalog-open');
        });
    } else {
        //в противном случае перемещаем в своё обычное место
        $('.js-header__basket').hover(function () {
            $('body').addClass('no-scroll');
            $('.js-menus').removeClass('is-open');
            $('.js-catalog-open').removeClass('is-active');
            $(this).addClass('is-active');
            $('.js-header').addClass('basket-open');
            $('.js-basket-menu').addClass('is-open');
            $('.js-overlay').removeClass('catalog-open');
            $('body').removeClass('menu-open');
        });
    }
}

$(document).ready(openSearch);
$(window).resize(openSearch);




function changeTemplate() {
    if ($(window).width() < 992) {
        //при ширине окна менее 768px перемещаем фильтр в шапку
        $('.product__info .product__title, .product__info .tags').prependTo('.product__gallery');
    } else {
        //в противном случае перемещаем в своё обычное место
        $('.product__gallery .product__title, .product__info .tags').prependTo('.product__info');
    }
}

$(document).ready(changeTemplate);
$(window).resize(changeTemplate);

//change position text in product page
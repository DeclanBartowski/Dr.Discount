$(document).ready(function (){
    $(document).on('click', '.js-product-favorite', function (){
        let id = $(this).data('id');
        BX.ajax.runAction('vpl:tools.favorite.favorite', {
            data: {
                id:id
            }
        }).then(function (response) {
            let object = $('.js-product-favorite[data-id="'+id+'"]');
            if(response.data.status) {
                object.addClass('is-active');
            } else {
                object.removeClass('is-active');
            }

            if(response.data.count < 1) {
                $('.js-count-favorite').hide();
            } else {
                $('.js-count-favorite').removeAttr('style');
            }

            $('.js-count-favorite').html(response.data.count);

        }, function (response) {
            console.log(response);
        });

    });

    $(document).on('click', '.js-delete-favorite', function (){
        let id = $(this).data('id');
        let object = $(this).parents('.card');
        BX.ajax.runAction('vpl:tools.favorite.delete', {
            data: {
                id:id
            }
        }).then(function (response) {
            object.remove();
            if(response.data.count < 1) {
                $('.favorites').after('В избранном нет товаров!');
                $('.account__favorites').after('В избранном нет товаров!');
                $('.favorites').remove();
                $('.account__favorites').remove();
                $('.js_favorite_count').text(response.data.count);
            }

            if(response.data.count < 1) {
                $('.js-count-favorite').hide();
            } else {
                $('.js-count-favorite').removeAttr('style');
            }

            $('.js-count-favorite').html(response.data.count);

        }, function (response) {
            console.log(response);
        });

    });

    $(document).on('change', '.js-quantity-update', function () {
        let quantity = $(this).val();
        let id = $(this).data('id');
        BX.ajax.runAction('vpl:tools.basket.changeQuantity', {
            data: {
                fields: {
                    ID: id,
                    VALUE: quantity
                }
            }
        }).then(function (response) {
            $('.basket').remove();
            $('h1').after(response.data.html);
            $(".js-input-touchspin").TouchSpin({});
            BX.onCustomEvent('OnBasketChange');
        }, function (response) {
            console.log(response);
        });
    });
    $(document).on('click', '.js-product-delete', function (){
        let id = $(this).data('id');
        BX.ajax.runAction('vpl:tools.basket.remove', {
            data: {
                fields: {
                    ID: id
                }
            }
        }).then(function (response) {
            $('.basket').remove();
            $('h1').after(response.data.html);
            $(".js-input-touchspin").TouchSpin({});
            BX.onCustomEvent('OnBasketChange');
        }, function (response) {
        });

    })
    $(document).on('click', '.js-basket__clear', function (){

        BX.ajax.runAction('vpl:tools.basket.clearAll', {
        }).then(function (response) {
            $('.basket').remove();
            $('h1').after(response.data.html);
            $(".js-input-touchspin").TouchSpin({});
            BX.onCustomEvent('OnBasketChange');
        }, function (response) {
        });

    })

    $(document).on('click', '.js_modal_brand', function (){
        let text = $(this).data('text');
        let picture = $(this).data('picture');
        let title = $(this).data('title');
        $('.js_brand_image').html(' ');
        $('.js_brand_title').text(title);
        $('.js_brand_text').html(text);
        if(picture.length > 0) {
            $('.js_brand_image').html('<img src="'+picture+'">');
        }
        $('#modalBrand').modal('show');
    })

    
    $(document).on('click', '.js_product_basket_element', function (){


        if($(this).hasClass('is-active')) {

            location.href='/basket/';
        } else {

            $(this).toggleClass('is-active');
            let id = $(this).data('id');
            let quantity = $('.js_quantity_basket_element').val();

            BX.ajax.runAction('vpl:tools.basket.add2Basket', {
                data: {
                    id: id,
                    quantity: quantity
                }
            }).then(function (response) {
                BX.onCustomEvent('OnBasketChange');
            }, function (response) {
                console.log(response);
            });
        }
    })


    $(document).on('click', '.js_add_item', function (){
        if($(this).hasClass('is-active')) {
            location.href='/basket/';
        } else {
            $(this).toggleClass('is-active');
            let id = $(this).data('id');
            let quantity = $(this).parents('.js-card').find('.js_quantity_item').val();
            BX.ajax.runAction('vpl:tools.basket.add2Basket', {
                data: {
                    id: id,
                    quantity: quantity
                }
            }).then(function (response) {
                BX.onCustomEvent('OnBasketChange');
            }, function (response) {
                console.log(response);
            });
        }
    })


    $(document).on('change', '.js-promocode', function (){

        let promocode = $(this).val();
        //setCoupon

        BX.ajax.runAction('vpl:tools.basket.setCoupon', {
            data: {
               'coupon' : promocode
            }
        }).then(function (response) {
            $('.basket').remove();
            $('h1').after(response.data.html);
            $(".js-input-touchspin").TouchSpin({});
            BX.onCustomEvent('OnBasketChange');
        }, function (response) {
            console.log(response);
        });

    })
    $(document).on('click','.js-callback-modal',function () {
        let modal = $($(this).data('target'));
        modal.modal('show');
    });
    $(document).on('input','.js-open-search',function () {
        let query = $(this).val();
        BX.ajax.runAction('vpl:tools.search.getHeadSearchHtml', {
            data: {
                'query':query
            }
        }).then(function (response) {
            $('.js-search-menu__wrap').html(response.data);
            $('.js-search-menu').addClass('is-active');
            OverlayScrollbars(document.querySelectorAll(".js-search-menu__scroll"), {});
        }, function (response) {
            console.log(response);
        });

    });


    $(document).on('click', '.catalog__show', function (){

        let view = $(this).data('view');
        BX.ajax.runAction('vpl:tools.catalog.setViewCatalog', {
            data: {
                'view' : view
            }
        }).then(function (response) {

        }, function (response) {
            console.log(response);
        });

    })


    $(document).on('click', '.js-sort-catalog', function (){

        let sort = $(this).data('sort');
        BX.ajax.runAction('vpl:tools.catalog.setSortCatalog', {
            data: {
                'sort' : sort
            }
        }).then(function (response) {

            $.get( location.href, function( data ) {
                $( ".catalog__wp" ).html( $(data).find('.catalog__wp').html() );
                $(".js-input-touchspin").TouchSpin({});
            });

        }, function (response) {
            console.log(response);
        });

    })
});

function updateCatalogFilter()
{
    $.get( $('.filterDesktop').attr('action'), $('.filterDesktop').serialize(),  function( data ) {
        $('#updateCatalog').html($(data).find('#updateCatalog').html());
        $(".js-input-touchspin").TouchSpin({});
    });
}


$(document).on('change', '.js-change-filter', function (){
    let parents = $(this).parents('.catalog__filter');
    let count = parents.find('input:checked').length;
    if(count == 0) {
        parents.find('input').prop('checked', false);
        parents.find('.catalog__numbers').html(0).hide();
        parents.find('.js-close-btn').hide();
        parents.find('.catalog__front').removeClass('catalog__front-full');
    } else {
        parents.find('.catalog__numbers').html(count).show();
        parents.find('.js-close-btn').show();
        parents.find('.catalog__front').addClass('catalog__front-full');
    }

    updateCatalogFilter();

});



$(document).on('click', '.js-close-btn',function (){
    let parents = $(this).parents('.catalog__filter');
    parents.find('input').prop('checked', false);
    parents.find('.catalog__numbers').html(0).hide();
    parents.find('.js-close-btn').hide();
    parents.find('.catalog__front').removeClass('catalog__front-full');
    updateCatalogFilter();
});

$(document).on('click','.js-buy-oneclick',function () {
    let id = $(this).data('id');
    let modal = $('#orderOneClickModal');
    modal.find('[name=productID]').val(id);
    modal.modal('show')
    return false;
});
$(document).on('submit','.js-order-one-click',function () {
    let data = $(this).serializeArray().reduce(function (a, x) {
        a[x.name] = x.value;
        return a;
    }, {});
    BX.ajax.runAction('vpl:tools.order.orderOneClick', {
        data: {
            data:data
        }
    }).then(function (response) {
        if(response.data){
            $('#orderOneClickModal').modal('hide');
            $('#modalThanksORder').modal('show');
        }
    }, function (response) {
        console.log(response);
    });
    return false;
});

$(document).on('click', '.js-exit', function () {
    BX.ajax.runAction('vpl:tools.user.logout', {}).then(function (response) {
        location.href = '/';
    }, function (response) {
        console.log(response);
    });
})
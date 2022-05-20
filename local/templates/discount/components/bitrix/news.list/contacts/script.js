$(function () {
    if ($('#map').length) {
        var mapHeight = $('#map').height();

        ymaps.ready(function () {

            var map = new ymaps.Map("map", {
                    center: [55.783225, 37.573816],
                    zoom: 16,
                    behaviors: ['default'],
                    controls: []
                }),
                MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                    '<span style="font-weight: 600;font-size: 18px;">{{ properties.geoObjects.length }}</span>'
                ),
                clusterer = new ymaps.Clusterer({
                    clusterIcons: [
                        {
                            href: SITE_TEMPLATE_PATH + '/img/pin.svg',
                            size: [60, 74],
                            offset: [-30, -35, 5]
                        },
                        {
                            href: SITE_TEMPLATE_PATH + '/img/pin.svg',
                            size: [60, 74],
                            offset: [-30, -35, 5]
                        }],
                    clusterNumbers: [100],
                    clusterIconContentLayout: MyIconContentLayout
                });


            var MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="popover">' +
                '<div class="popover__arrow"></div>' +
                '<div class="popover__inner">' +
                '<a class="popover__close" href="#"><svg class="icon' +
                ' icon-icon-close"><use' +
                ' xlink:href="#icon-close"></use></svg></a>' +
                '$[[options.contentLayout observeSize minWidth=472 maxWidth=472]]' +
                '<span class="popover__tail"></span>' +
                '</div>' +
                '</div>', {
                    build: function () {
                        this.constructor.superclass.build.call(this);

                        this._$element = $('.popover', this.getParentElement());

                        this.applyElementOffset();

                        this._$element.find('.popover__close')
                            .on('click', $.proxy(this.onCloseClick, this));
                    },
                    clear: function () {
                        this._$element.find('.popover__close')
                            .off('click');

                        this.constructor.superclass.clear.call(this);
                    },
                    onSublayoutSizeChange: function () {
                        MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

                        if (!this._isElement(this._$element)) {
                            return;
                        }

                        this.applyElementOffset();

                        this.events.fire('shapechange');
                    },
                    applyElementOffset: function () {
                        this._$element.css({
                            left: -(this._$element[0].offsetWidth / 8),
                            top: -(this._$element[0].offsetHeight + this._$element.find('.popover__arrow')[0].offsetHeight)
                        });
                    },
                    onCloseClick: function (e) {
                        e.preventDefault();

                        this.events.fire('userclose');
                    },
                    getShape: function () {
                        if (!this._isElement(this._$element)) {
                            return MyBalloonLayout.superclass.getShape.call(this);
                        }

                        var position = this._$element.position();

                        return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                            [position.left, position.top], [
                                position.left + this._$element[0].offsetWidth,
                                position.top + this._$element[0].offsetHeight + this._$element.find('.popover__arrow')[0].offsetHeight
                            ]
                        ]));
                    },
                    _isElement: function (element) {
                        return element && element[0] && element.find('.popover__arrow')[0];
                    }
                });

            var MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="popover__content">$[properties.balloonContent]</div>'
            );

            map.behaviors.disable(['scrollZoom']);

            geoObjects = [];


            for (let key in contactsData) {
                var balloon = '<div class="ballon">' +
                    '<div class="ballon__head">' +
                    '<div class="baloon__logo">' + contactsData[key]['name'] +
                    '</div>' +
                    '</div>' +
                    '<div class="baloon__body">' +
                    '<div class="baloon__body-content">';

                    if (contactsData[key]['phone']) {
                        balloon += '<div class="contact-icon contact-icon--tel"><svg class="icon icon-icon-tel"><use xlink:href="#icon-tel"></use></svg><a href="tel:'+contactsData[key]['phone']+'" class="tel">'+contactsData[key]['phone']+'</a></div>';
                    }
                    if (contactsData[key]['email']) {
                        balloon += '<div class="contact-icon contact-icon--mail"><svg class="icon icon-icon-mail"><use xlink:href="#icon-mail"></use></svg><a href="mailto:'+contactsData[key]['email']+'" class="mail">'+contactsData[key]['email']+'</a></div>';
                    }
                    if (contactsData[key]['work_time']) {
                        balloon += '<div class="contact-icon contact-icon--time"><svg class="icon icon-clock"><use xlink:href="#icon-clock"></use></svg><div class="time">'+contactsData[key]['work_time']+'</div></div>';
                    }
                    if (contactsData[key]['address']) {
                        balloon += '<div class="contact-icon contact-icon--address"><svg class="icon icon-icon-pin"><use xlink:href="#icon-pin"></use></svg><div class="address">'+contactsData[key]['address']+'</div></div>';
                    }
                    balloon += '</div></div></div>';


                    let coordinates = contactsData[key]['coordinates'].split(',');

                geoObjects[key] = new ymaps.Placemark([parseFloat(coordinates[0]), parseFloat(coordinates[1])], {
                    balloonContent: balloon,
                    hintContent: contactsData[key]['name'],
                }, {
                    balloonLayout: MyBalloonLayout,
                    balloonContentLayout: MyBalloonContentLayout,
                    iconLayout: 'default#image',
                    iconImageHref: SITE_TEMPLATE_PATH + '/img/pin.svg',
                    iconImageSize: [60, 74],
                    offset: [-30, -35, 5]
                });
            }

            clusterer.add(geoObjects);
            map.geoObjects.add(clusterer);

            map.controls.add('zoomControl', {
                size: 'small',
                float: 'none',
                position: {
                    top: mapHeight / 2 - 30,
                    right: '16px'
                }
            });
        });
    }
});
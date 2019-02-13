function bodyClass($class) {
    return $('body').hasClass($class);
}

const MobileMenu = {
    toggleMenuMobile() {
        $('.mobile-btn').toggleClass('open');
        $('.menu-container, body').toggleClass('open-menu');
    },
    controller() {
        $("#mobile-menu").click(() => {
            this.toggleMenuMobile();
        });
    }
};

class Mail {
    constructor() {
        $('.contact-form form').submit((e) => {
            e.preventDefault();
            this.contact();
        });
        $('#order form').submit((e) => {
            e.preventDefault();
            this.order();
        });
        $('.first-step input').change(() => this.makeList());
    }

    contact() {
        const data = {
            action: 'mail',
            subject: 'Обратная связь',
            name: $('.contact-form input[name=name]').val(),
            email: $('.contact-form input[name=email]').val(),
            message: nl2br($('.contact-form textarea[name=message]').val(), true)
        };
        this.send(data);
    }

    order() {
        const data = {
            action: 'mail',
            subject: 'Заказ',
            name: $('#order input[name=name]').val(),
            tel: $('#order input[name=tel]').val(),
            email: $('#order input[name=email]').val(),
            products: []
        };
        $('.first-step input:checked').each(function () {
            data.products.push($(this).val())
        });
        this.send(data, true);
    }

    makeList() {
        let $inputs = $('.first-step input:checked');
        if ($inputs.length === 0) {
            $('.order-block').hide();
        } else {
            $('.order-block').show();
            $('.order-list').empty();
            $inputs.each(function (i) {
                let title = $(this).val();
                $('.order-list').append(`<p>${i + 1}) ${title}</p>`);
            });
        }
    }

    send(data, prev = false) {
        if (grecaptcha.getResponse()) {
            $.post(AdminAjax, data).done((res) => {
                res = JSON.parse(res);
                $('.modal').modal('hide');
                if (res.status === 'ok') {
                    $('#thanks').modal('show');
                    $("form")[0].reset();
                } else {
                    $('#sorry').modal('show');
                }
                if (prev) {
                    $('.second-step').fadeOut(function () {
                        $('.first-step').fadeIn();
                    });
                }
                setTimeout(() => {
                    $('.modal').modal('hide');
                }, 5000);
            });
        }
    }
}

class GoogleMap {
    constructor() {
        this.markers = [];
        this.inputs = document.querySelectorAll('.map input');

        this.map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.5, lng: 34},
            disableDefaultUI: true,
            zoom: 6
        });

        this.init();

        this.inputs.forEach(input => {
            input.addEventListener('change', e => {
                let input = e.currentTarget,
                    index = input.getAttribute('data-client'),
                    value = input.checked;
                this.toggle(index, value);
            });
        });
    }

    init() {
        this.inputs.forEach((input, index) => this.markers[index] = []);

        MapData.forEach((client, i) => {
            client.color = client.color.replace('#', '');
            client.markers.forEach(location => {
                location.lat = +location.lat;
                location.lng = +location.lng;
                this.addMarker(i, location, client.color);
            });
        });

        let checked = document.querySelectorAll('.map input:checked');

        checked.forEach((input, index) => {
            let value = input.checked;
            this.toggle(index, value);
        });
    }

    toggle(index, value) {
        this.markers[index].forEach(marker => marker.setMap(value ? this.map : null));
    }

    addMarker(index, location, color = 'ff5489') {
        let pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + color,
            new google.maps.Size(21, 34),
            new google.maps.Point(0, 0),
            new google.maps.Point(10, 34));

        let marker = new google.maps.Marker({
            position: location,
            icon: pinImage,
        });
        this.markers[index].push(marker);
    }
}

function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br/>' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

$(() => {
    $("#next").click((e) => {
        e.preventDefault();
        $('.first-step').fadeOut(function () {
            $('.second-step').fadeIn();
        });
    });
    $("#prev").click((e) => {
        e.preventDefault();
        $('.second-step').fadeOut(function () {
            $('.first-step').fadeIn();
        });
    });
    $('.phone').inputmask("mask", {"mask": "+38 (999) 999-99-99", "clearIncomplete": true});
    $(window).on('load resize scroll', () => {
        if ($(this).scrollTop() > 50 && window.innerWidth > 992) {
            $(".header").addClass('sticky-header');
            //$(".header ul, .header .logo").removeClass('wow');
            //$(".header ul, .header .logo").css('visibility', 'visible');
        } else {
            $(".header").removeClass('sticky-header');
            //$(".header ul, .header .logo").addClass('wow');
            //$(".header ul, .header .logo").css('visibility', 'hidden');

        }
    });
    $('#reviews').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 1,
        loop: false
    });
    $('.last-works-carousel').owlCarousel({
        dots: true,
        items: 4,
        margin: 30,
        loop: false,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1
            },
            570: {
                items: 2
            },
            // breakpoint from 768 up
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
    $('#last-works').owlCarousel({
        dots: true,
        items: 4,
        margin: 30,
        loop: true,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1
            },
            570: {
                items: 2
            },
            // breakpoint from 768 up
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
    $('#gallery-photo').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 1,
        loop: true
    });
    $('.gallery-photo-carousel').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 1,
        loop: true
    });
    $('#reviews-page').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 1,
        loop: false
    });
    $('#partners').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 5,
        loop: true,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1
            },
            // breakpoint from 480 up
            370: {
                items: 2
            },
            500: {
                items: 3
            },
            // breakpoint from 768 up
            768: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('#reward').owlCarousel({
        dots: true,
        slideBy: 1,
        items: 2,
        loop: true,
        margin: 30,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            }
        }
    });

    let wow = new WOW({mobile: false});
    wow.init();

    $('.scrollbar-inner').scrollbar();

    MobileMenu.controller();

    new Mail();
});

$(window).on('load', () => {
    setTimeout(() => {
        if (bodyClass('home') || bodyClass('page-template-about')|| bodyClass('page-template-guarantee')) {
            new GoogleMap();
        }
        ReLoadImages();
    }, 2000);
});

function ReLoadImages() {
    $('*[data-lazysrc]').each(function () {
            $(this).attr('src', $(this).attr('data-lazysrc'));
        }
    );
}
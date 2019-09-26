var include_path = $("link[rel='include_path']").attr("href");
var item = $('.owl-carousel').attr('data-owl-items');
$(".owl-carousel").owlCarousel({
    items: item
});
$('html').delegate('.trigger, .menu-trigger', 'click', function () {
    var target = $(this).attr('data-target');
    $(target).slideToggle();
});
$('html').delegate('.close-modal', 'click', function () {
    var target = $('.modal');
    $(target).fadeOut();
});
$('html').delegate('.remove-modal', 'click', function () {
    var target = $(this).attr('data-target');
    $(target).fadeOut(function(){
         $(target).remove();
    });
});
$('html').delegate('.open-modal', 'click', function () {
    var target = $(this).attr('data-target');
    $(target).fadeIn();
});
$('html').delegate('.close-comp', 'click', function () {
    var target = $(this).attr('data-close');
    $(target).slideUp();
});
$('html').delegate('.remove-comp', 'click', function () {
    var target = $(this).attr('data-remove');
    $(target).fadeOut();
});
$('html').delegate('.open-alert', 'click', function () {
    var target = $(this).attr('data-target');
    $(target).slideToggle();
});
$('html').delegate('.tooltip-cont', 'click', function () {
    var target = $(this).find('.tooltip');
    $(target).toggle();
});

$('html').delegate('.tooltip', 'click', function () {
    $(this).fadeOut();
});

$('html').delegate('.open-lista-desejos', 'click', function () {
    var dataPost = {action: 'open'};
    ajax('body', '/ajax/modal.lista.desejos', dataPost, $(this));
});

$('html').delegate('.j-add-desejos', 'click', function () {
    console.log('click');
    var form = $(this).attr('data-form');
    var endPoint = $(form).attr('data-end-point');
    var dataPost = {id: $(this).attr('data-id'), action: $(this).attr('data-action')};
    ajax($(form), endPoint, dataPost, $(this));
});
function ajax(form, endPoint, dataPost, elem) {
    $.ajax({
        url: include_path + endPoint + '.ajax.php',
        dataType: 'json',
        data: dataPost,
        type: 'POST',
        beforeSend: function () {
            $(form).find('.ajax-return').html('<span class="loading"></span>');
        },
        success: function (data) {
            if (data.return) {
                $(form).find('.ajax-return').html(data.return);
            }
            if (data.add_lista) {
                $(elem).attr('src', data.img).attr('data-action', data.action);
            }
            if (data.lista_desejos) {
                $('body').append(data.lista_desejos);
                $('#lista').fadeIn();
            }
        }
    });
}

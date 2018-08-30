$(document).ready(function () {

    // cancel form submission
    $('#search-domains-form').submit(function (event) {
        event.preventDefault();
    });
    // cancel form submission



    // Live search domains (AJAX)
    $('#search').on('keyup', function () {
        var val = $(this).val();
        if ($.trim(val).length > 0) {
            $.ajax({
                type: 'GET',
                url: '/search',
                data: {search: val},
                success: function (data) {
                    $('#domains-list').html(data);
                }
            });
        } else {
            $('#domains-list').html('<a class="list-group-item list-group-item-action">No matches found...</a>');
        }
    });
    // Live search domains (AJAX)


    // Update form validate
    $('#update_name').on('keyup', function () {
        var val = $(this).val();
        if ($.trim(val).length > 0) {
            $.ajax({
                type: 'GET',
                url: '/account/dynamic-check',
                data: {search: val},
                success: function (data) {
                    console.log(data);
                    var input = $('#update_name');
                    var btn = $('#update_btn');
                    if (data == 0) {
                        input.removeClass('is-invalid');
                        input.addClass('is-valid');
                        btn.prop('disabled', false);
                    } else {
                        input.removeClass('is-valid');
                        input.addClass('is-invalid');
                        btn.prop('disabled', true);
                    }
                }
            });
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }

    });
    // Update form validate

});

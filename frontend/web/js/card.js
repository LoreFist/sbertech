$(function () {
    var data;

    $('.item').on('click', function () {
        data = $(this).data();
        $('#modal-' + data.key).modal('show');
        $.post(
            'card/view',
            {data: {
                key: data.key
                }
            }
        )
    });

    $('.close').on('click', function () {
        $('#modal-' + data.key).modal('hide');
    });
})
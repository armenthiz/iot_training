$(document).ready(function() {
    // pagination function
    function get_page(page) {
        $.ajax({
            url: '/articles?page=' + page,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.panel-body').html(data.view);
            },
            error: function (xhr, status, error) {
                console.log(xhr.error + "\n Error Status : " + status + "\n" + error);
            },
            complete: function () {
                alreadyloading = false;
            }
        });
    }

    // sorting function
    function sort_articles() {
        $(document).on('click', '#id', function () {
            $.ajax({
                url: '/articles',
                type: 'GET',
                dataType: 'json',
                data: {
                    direction: $('#direction').val()
                },
                success: function (data)
                {
                    $('.panel-body').html(data.view);
                    $('#direction').val(data.direction);
                    if (data.direction == 'asc') {
                        $('i#ic-direction').attr({class: 'fa fa-arrow-up'});
                    } else {
                        $('i#ic-direction').attr({class: 'fa fa-arrow-down'});
                    }
                },
                error: function (xhr, status, error)
                {
                    console.log(xhr.error + "\n Error Status : " + status + "\n" + error)
                },
                complete: function ()
                {
                    alreadyloading = false;
                }
            });
        });
    }

    $('.article_link').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/articles',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.panel-body').html(data.view);
            },
            error: function (xhr, status) {
                console.log(xhr.error);
            }
        });
    });

    $(document).on('click', '.pagination a', function (e) {
        get_page($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });

    // Searching Handler
    $(document).on('click', '#search', function () {
        $.ajax({
            url: '/articles',
            type: 'GET',
            dataType: 'json',
            data: {
                keywords: $('#keywords').val()
            },
            success: function (data) {
                $('.panel-body').html(data.view);
            },
            error: function (xhr, status) {
                console.log(xhr.error + " Error Status" + status);
            },
            complete: function () {
                alreadyloading = false;
            }
        });
    });

    // Sorting Handler
    $(document).on('click', '#id', function (e) {
        sort_articles();
        e.preventDefault();
    });
});
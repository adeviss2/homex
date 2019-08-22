$(document).ready(function() {

    $("#submiturl_").submit(function(e) {
        toastr.info('Form submitted by URL', 'Extractor started');
        var data = $(this).serialize();
        e.preventDefault();
        ajaxCall(data, 'btnurl');
    });
    $("#submitid_").submit(function(u) {
        toastr.info('Form submitted by ID', 'Extractor started');
        var data = $(this).serialize();
        u.preventDefault();
        ajaxCall(data, 'btnid');
    });
    $(".view").click(function() {
        var id = $(this).attr('id');
        var url = 'view.php?id=' + id
        window.location = url;
    });

});

function ajaxCall(data, btn) {
    var button = $("#" + btn);
    button.addClass('running');
    button.attr('disabled', true);
    $.post({
        type: "POST",
        url: "/home/extract",
        data: data,
        success: function(data) {
            console.log(data);
            toastr.success('Property successfully extracted. Refresh page to view the new property added.', 'Success!');
            button.removeClass('running');
            button.attr('disabled', false);
        }
    })
}

$(document).ready(function() {

    // Display the current window/pane width
    $('#currentWidth').text($(window).width());

    // When the window is resized, update the displayed window/pane width
    $(window).on('resize', function() {
        $('#currentWidth').text($(window).width());
    });

});

$(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
        window.localStorage.removeItem("activeTab");
    }
});
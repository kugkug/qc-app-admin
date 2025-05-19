$(document).ready(function () {
    if ($(".card-button").length) {
        $(".card-button").off();
        $(".card-button").on("click", function () {
            window.location = $(this).attr("data-path");
        });
    }
});

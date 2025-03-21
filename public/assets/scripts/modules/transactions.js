$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/transactions/list/" + $("#id").val());
    }

    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let parentForm = $(this).closest("form");
        switch (trigger) {
            case "submit":
                if (!_checkFormFields(parentForm)) {
                    _systemAlert(
                        "warning",
                        "Please complete the required fields!"
                    );
                    return;
                }

                let json_data_form = JSON.parse(_collectFields(parentForm));
                let image = $($(".image-upload").next("[type=file]"))[0]
                    .files[0];
                let form_data = new FormData();
                form_data.append("Image", image);
                $.each(json_data_form, function (i, j) {
                    form_data.append(i, j);
                });

                ajaxSubmit(
                    "/execute/transactions/save/" + +$("#id").val(),
                    form_data,
                    $(this)
                );
                break;
            case "update":
                if (!_checkFormFields(parentForm)) {
                    _systemAlert(
                        "warning",
                        "Please complete the required fields!"
                    );
                    return;
                }
                let data_form_update = JSON.parse(_collectFields(parentForm));
                data_form_update = {
                    ...data_form_update,
                    Id: $("#id").val(),
                };
                ajaxRequest(
                    "/execute/players/update",
                    data_form_update,
                    $(this)
                );
                break;
        }
    });
});

function _fetch(targetUrl = "") {
    ajaxRequest(targetUrl, "", "");
}

function _execWidget() {
    if ($(".page-link").length > 0) {
        $(".page-link").off();
        $(".page-link").on("click", function (e) {
            e.preventDefault();
            let pageno = $(this).attr("data-page");

            _fetch(
                "/execute/transactions/" + $("#id").val() + "/list?" + pageno
            );
        });
    }

    if ($("[data-delete]").length) {
        $("[data-delete]").off();
        $("[data-delete]").on("click", function (e) {
            e.preventDefault();
            let employee_id = $(this).attr("data-delete");

            _confirm(
                "alert",
                "Are you sure you want to deactivate this account?"
            );
        });
    }

    if ($("[data-reset]").length) {
        $("[data-reset]").off();
        $("[data-reset]").on("click", function (e) {
            e.preventDefault();
            let employee_id = $(this).attr("data-reset");

            ajaxRequest(
                "/execute/players/reset-password",
                { Id: employee_id },
                $(this)
            );
        });
    }
}

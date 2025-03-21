$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/company/list");
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

                ajaxSubmit("/execute/company/save", form_data, $(this));
                break;

            case "update":
                if (!_checkFormFields(parentForm)) {
                    _systemAlert(
                        "warning",
                        "Please complete the required fields!"
                    );
                    return;
                }

                let json_data_update = JSON.parse(_collectFields(parentForm));
                let image_update = $($(".image-upload").next("[type=file]"))[0]
                    .files[0];

                let form_data_update = new FormData();
                form_data_update.append("Image", image_update);
                $.each(json_data_update, function (i, j) {
                    form_data_update.append(i, j);
                });

                ajaxSubmit(
                    "/execute/company/update/" + $("[data-key=Id]").val(),
                    form_data_update,
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
            _fetch("/execute/company/list?" + pageno);
        });
    }

    if ($("[data-delete]").length) {
        $("[data-delete]").off();
        $("[data-delete]").on("click", function (e) {
            e.preventDefault();
            let company_id = $(this).attr("data-delete");

            _confirm("alert", "Are you sure you want to delete this company?");
        });
    }
}

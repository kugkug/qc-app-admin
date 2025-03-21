$(document).ready(function () {
    if ($(".div-table-data").length) {
        _fetch("/execute/accounts/list");
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
                let data_form_save = JSON.parse(_collectFields(parentForm));

                ajaxRequest("/execute/accounts/save", data_form_save, $(this));
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
                    Id: $(this).attr("data-id"),
                };
                ajaxRequest(
                    "/execute/accounts/update",
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
            _fetch("/execute/accounts/list?" + pageno);
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
                "/execute/accounts/reset-password",
                { Id: employee_id },
                $(this)
            );
        });
    }
}

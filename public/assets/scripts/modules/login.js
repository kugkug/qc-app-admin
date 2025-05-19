$(document).ready(function () {
    if ($("[data-trigger=login]").length) {
        $("[data-trigger=login]").off();
        $("[data-trigger=login]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));

            ajaxRequest("/executor/login", json_data_form, $(this));
        });
    }
});

$(document).ready(function () {
    $(".chk-req").on("click", function () {
        let chkCheckedCnt = 0;
        let chkReq = $(".chk-req");

        for (const chk of chkReq) {
            if ($(chk).is(":checked")) chkCheckedCnt++;
        }

        if (chkCheckedCnt == chkReq.length)
            $("[data-trigger=register]").attr("disabled", false);
        else $("[data-trigger=register]").attr("disabled", true);
    });

    if ($("[data-trigger=register]").length) {
        $("[data-trigger=register]").off();
        $("[data-trigger=register]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            ajaxRequest(
                "/executor/applicant/register",
                json_data_form,
                $(this)
            );
        });
    }

    if ($("[data-trigger=login]").length) {
        $("[data-trigger=login]").off();
        $("[data-trigger=login]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            ajaxRequest("/executor/applicant/login", json_data_form, $(this));
        });
    }
});

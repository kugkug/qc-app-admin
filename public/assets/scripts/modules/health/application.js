$(document).ready(function () {
    if ($("[data-trigger=apply-health-certificate]").length) {
        $("[data-trigger=apply-health-certificate]").off();
        $("[data-trigger=apply-health-certificate]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            ajaxRequest(
                "/executor/applicant/application",
                json_data_form,
                $(this)
            );
        });
    }

    if ($("[data-trigger=process-application]").length) {
        $("[data-trigger=process-application]").off();
        $("[data-trigger=process-application]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));

            ajaxRequest(
                "/executor/applicant/application/" + $(this).attr("data-refno"),
                json_data_form,
                $(this)
            );
        });
    }

    if ($(".chk-req").length) {
        $(".chk-req").off();
        $(".chk-req").on("click", function () {
            let chkCheckedCnt = 0;
            let chkReq = $(".chk-req");

            for (const chk of chkReq) {
                if ($(chk).is(":checked")) chkCheckedCnt++;
            }

            if (chkCheckedCnt == chkReq.length)
                $("[data-trigger=process-application]").attr("disabled", false);
            else $("[data-trigger=process-application]").attr("disabled", true);
        });
    }
});

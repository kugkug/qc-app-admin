$(document).ready(function () {
    enablePaymentOrder();
    if ($(".btn-preview").length) {
        $(".btn-preview").off();
        $(".btn-preview").on("click", function (e) {
            $("#modal-preview .modal-body").html(
                "<img src='" +
                    $(this).attr("data-image") +
                    "' class='image-responsive' style='width: 400px;'/>"
            );
            $("#modal-preview .btn").attr("data-id", $(this).attr("data-id"));
            $("#modal-preview").modal("show");
        });
    }
    if ($(".btn-require-update").length) {
        $(".btn-require-update").off();
        $(".btn-require-update").on("click", function (e) {
            let data_id = $(this).attr("data-id");
            $(".btn-submit-note").attr("data-id", $(this).attr("data-id"));
            $("#modal-notes").modal("show");
        });
    }

    if ($(".btn-head-approve").length) {
        $(".btn-head-approve").off();
        $(".btn-head-approve").on("click", function (e) {
            let data_ref_no = $(this).attr("data-ref-no");
            let data_status = $(this).attr("data-status");

            ajaxRequest(
                "/executor/head/approval/" + data_ref_no,
                { ApplicationStatus: data_status },
                $(this)
            );
        });
    }

    if ($(".btn-submit-note").length) {
        $(".btn-submit-note").off();
        $(".btn-submit-note").on("click", function (e) {
            let data_id = $(this).attr("data-id");
            let data_status = $(this).attr("data-status");

            ajaxRequest(
                "/executor/requirement/update/" + data_id,
                {
                    Status: data_status,
                    Notes: $("[data-key=Notes]").val(),
                    RefNo: $("[data-key=RefNo]").val(),
                },
                $(this)
            );
        });
    }

    if ($(".btn-payment-preview").length) {
        $(".btn-payment-preview").off();
        $(".btn-payment-preview").on("click", function (e) {
            $("#modal-payment-preview .div-receipt").html(
                "<img src='" +
                    $(this).attr("data-image") +
                    "' class='image-responsive' style='width: 400px;'/>"
            );
            $("#modal-payment-preview .btn").attr(
                "data-id",
                $(this).attr("data-id")
            );
            $("#modal-payment-preview").modal("show");
        });
    }

    if ($(".btn-require-update-payment").length) {
        $(".btn-require-update-payment").off();
        $(".btn-require-update-payment").on("click", function (e) {
            let data_ref_no = $(this).attr("data-ref-no");
            let data_status = $(this).attr("data-status");

            $(".btn-submit-note-payment").attr(
                "data-id",
                $(this).attr("data-id")
            );
            $("#modal-notes-payment").modal("show");
        });
    }
    if ($(".btn-submit-note-payment").length) {
        $(".btn-submit-note-payment").off();
        $(".btn-submit-note-payment").on("click", function (e) {
            let data_ref_no = $(this).attr("data-ref-no");
            let data_status = $(this).attr("data-status");

            ajaxRequest(
                "/executor/payment/update/" + data_ref_no,
                {
                    Status: data_status,
                    Notes: $("[data-key=Notes]").val(),
                },
                $(this)
            );
        });
    }
});

function enablePaymentOrder() {
    let statuses = $(".td-status");
    let status_len = statuses.length;
    let approve_text = $(".btn-head-approve").attr("data-status-text");
    let cntr = 0;
    for (let status of statuses) {
        let status_text = $(status).text().trim();
        if (status_text === approve_text) {
            cntr++;
        }
    }

    if (cntr === status_len) $(".btn-head-approve").attr("disabled", false);
    else $(".btn-head-approve").attr("disabled", true);
}

$(document).ready(function () {
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
                "/executor/head/business-approval/" + data_ref_no,
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
                "/executor/requirement/business-update/" + data_id,
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
});

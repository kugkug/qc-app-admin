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

    if ($(".btn-approve").length) {
        $(".btn-approve").off();
        $(".btn-approve").on("click", function (e) {
            let data_ref_no = $(this).attr("data-ref-no");
            let data_status = $(this).attr("data-status");

            ajaxRequest(
                "/executor/payment/business-update/" + data_ref_no,
                { Status: data_status },
                $(this)
            );
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
});

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

    if ($(".btn-approve").length) {
        $(".btn-approve").off();
        $(".btn-approve").on("click", function (e) {
            let data_id = $(this).attr("data-id");
            let data_status = $(this).attr("data-status");

            ajaxRequest(
                "/executor/requirement/business-update/" + data_id,
                { Status: data_status },
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
                    RefNo: $(this).attr("data-ref-no"),
                },
                $(this)
            );
        });
    }

    if ($(".btn-payment-order").length) {
        $(".btn-payment-order").off();
        $(".btn-payment-order").on("click", function (e) {
            let data_ref_no = $(this).attr("data-ref-no");
            $("#modal-payment-order").modal("show");
        });
    }

    if ($(".chk-pay-type").length) {
        $(".chk-pay-type").off();
        $(".chk-pay-type").on("click", function (e) {
            let is_checked = $(this).is(":checked");
            let parent_tr = $(this).closest("tr");
            let amount = $(parent_tr).find(".txt-amount")[0];

            if (is_checked) {
                $(amount).attr("disabled", false);
                $(amount).focus();
            } else {
                $(amount).attr("disabled", true);
            }

            calcPaymentOrder();
        });
    }

    if ($(".txt-amount").length) {
        $(".txt-amount").off();
        $(".txt-amount").on("keyup", function (e) {
            calcPaymentOrder();
        });
    }

    if ($(".btn-submit-payment-order").length) {
        $(".btn-submit-payment-order").off();
        $(".btn-submit-payment-order").on("click", function (e) {
            let app_ref_no = $(this).attr("data-ref-no");

            ajaxRequest(
                "/executor/payment/business-create/" + app_ref_no,
                {},
                $(this)
            );
        });
    }
});

function enablePaymentOrder() {
    let statuses = $(".td-status");
    let status_len = statuses.length;
    let approve_text = $(".btn-submit-payment-order").attr("data-status");
    let cntr = 0;
    for (let status of statuses) {
        let status_text = $(status).text().trim();
        if (status_text === approve_text) {
            cntr++;
        }
    }

    if (cntr === status_len)
        $(".btn-submit-payment-order").attr("disabled", false);
    else $(".btn-submit-payment-order").attr("disabled", true);
}

function calcPaymentOrder() {
    let selecteds = $(".chk-pay-type:checked");

    if (!selecteds) return;

    let total = 0;

    for (let selected of selecteds) {
        let parent_tr = $(selected).closest("tr");
        let amount = $($(parent_tr).find(".txt-amount")[0]).val();

        total += amount != "" ? parseFloat(amount) : 0;
    }

    $(".txt-total").val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}

function getPaymentDetails() {
    let selecteds = $(".chk-pay-type:checked");

    if (!selecteds.length) return false;

    let details = [];

    for (let selected of selecteds) {
        let payment_id = $(selected).attr("data-id");
        let parent_tr = $(selected).closest("tr");
        let amount = $($(parent_tr).find(".txt-amount")[0]).val();

        details.push({ id: payment_id, amount: amount });
    }

    return details;
}

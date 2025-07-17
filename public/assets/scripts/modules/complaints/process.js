$(document).ready(function () {
    if ($(".btn-add-recommendation").length) {
        $(".btn-add-recommendation").off();
        $(".btn-add-recommendation").on("click", function (e) {
            $("#modal-recommendation").modal("show");
        });
    }

    if ($(".btn-submit-recommendation").length) {
        $(".btn-submit-recommendation").off();
        $(".btn-submit-recommendation").on("click", function (e) {
            let ref_no = $(this).attr("data-ref-no");
            let status = $(this).attr("data-status");
            let recommendation = $("[data-key=FirstRecommendation]").val();

            let data = {
                RecommendationFirst: recommendation,
                Status: status,
            };

            ajaxRequest(
                "/executor/complaints/recommendation-first/" + ref_no,
                data,
                "POST"
            );
        });
    }

    if ($(".btn-submit-recommendation-second").length) {
        $(".btn-submit-recommendation-second").off();
        $(".btn-submit-recommendation-second").on("click", function (e) {
            let ref_no = $(this).attr("data-ref-no");
            let status = $(this).attr("data-status");
            let recommendation = $("[data-key=SecondRecommendation]").val();
            let data = {
                RecommendationSecond: recommendation,
                Status: status,
            };

            ajaxRequest(
                "/executor/complaints/recommendation-second/" + ref_no,
                data,
                "POST"
            );
        });
    }

    if ($(".btn-submit-recommendation-third").length) {
        $(".btn-submit-recommendation-third").off();
        $(".btn-submit-recommendation-third").on("click", function (e) {
            let ref_no = $(this).attr("data-ref-no");
            let status = $(this).attr("data-status");
            let recommendation = $("[data-key=ThirdRecommendation]").val();
            let data = {
                RecommendationThird: recommendation,
                Status: status,
            };

            ajaxRequest(
                "/executor/complaints/recommendation-third/" + ref_no,
                data,
                "POST"
            );
        });
    }

    if ($(".btn-apply-for-head-approval").length) {
        $(".btn-apply-for-head-approval").off();
        $(".btn-apply-for-head-approval").on("click", function (e) {
            let ref_no = $(this).attr("data-ref-no");
            let status = $(this).attr("data-status");
            let data = {
                Status: status,
            };

            ajaxRequest(
                "/executor/complaints/head-approval/" + ref_no,
                data,
                "POST"
            );
        });
    }

    if ($(".btn-resolve-complaint").length) {
        $(".btn-resolve-complaint").off();
        $(".btn-resolve-complaint").on("click", function (e) {
            let ref_no = $(this).attr("data-ref-no");
            let status = $(this).attr("data-status");
            let data = {
                Status: status,
            };

            ajaxRequest(
                "/executor/complaints/resolved/" + ref_no,
                data,
                "POST"
            );
        });
    }
});

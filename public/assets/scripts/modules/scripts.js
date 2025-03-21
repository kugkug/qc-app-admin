let theme = "light";
$(document).ready(function () {
    let classes = $("body").attr("class");
    if (classes.indexOf("dark-mode") > -1) {
        theme = "dark";
    }

    let current_image = "";
    if ($(".image-uploaded").length) {
        $(".image-uploaded").off();
        $(".image-uploaded").on("click", function () {
            let parentDiv = $(this).closest(".div-image-uploader");
            let modal = $(parentDiv).find("div.modal");
            current_image = $(this).attr("src");

            $(".image-upload").attr("src", current_image);
            if (modal.length) {
                $(modal[0]).modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true,
                });
            }
        });
    }

    if ($(".image-upload").length) {
        $(".image-upload").off();
        $(".image-upload").on("click", function () {
            let file = $(this).next("[type=file]");

            if (file.length) {
                $(file).off();
                $(file).click();
                $(file).on("change", function (e) {
                    var nSize = $(this).get(0).files[0].size;
                    var sFileName = $(this).get(0).files[0].name;
                    var sFullPath = URL.createObjectURL(e.target.files[0]);

                    var aFileName = sFileName.split(".");
                    var sFileType =
                        aFileName[aFileName.length - 1].toLowerCase();

                    var fSExt = new Array("Bytes", "KB", "MB", "GB"),
                        h = 0;
                    while (nSize > 900) {
                        nSize /= 1024;
                        h++;
                    }

                    var vFileName = "";
                    var sInvalid = "";
                    var sTooLarge = "";
                    var sWrongCamp = "";

                    var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
                    var vSizeCat = fSExt[h];
                    var sSize = nExactSize + "" + vSizeCat;

                    if (
                        sFileType != "png" &&
                        sFileType != "jpg" &&
                        sFileType != "jpeg"
                    ) {
                        sInvalid += sFileName + " - " + sFileType + ".<br />";
                    } else {
                        if (h < 3) {
                            if (h == 2 && nExactSize > 25) {
                                sTooLarge +=
                                    sFileName + " - " + sSize + ".<br />";
                            } else {
                                vFileName += sFileName + "\n\n";
                            }
                        } else {
                            sTooLarge += sFileName + " - " + sSize + ".<br />";
                        }
                    }

                    var sMessage = "";

                    if (sInvalid != "") {
                        sMessage +=
                            "<b>File/s Invalid Format:</b> <br />" +
                            sInvalid +
                            "<br /><br />";
                    }

                    if (sTooLarge != "") {
                        sMessage +=
                            "<b>File/s Too Large:</b> <br />" +
                            sTooLarge +
                            "<br /><br />";
                    }

                    sMessage +=
                        "Please be advised, this system can only accept PNG, JPG and JPEG formatted file with up to 25MB max size.";

                    if (sTooLarge != "" || sInvalid != "" || sWrongCamp != "") {
                        $(this).val("");
                        _systemAlert("alert", sMessage);
                    } else {
                        $(".image-upload").attr("src", sFullPath);
                    }
                });
            }
        });

        $("#btn-use-photo").off();
        $("#btn-use-photo").on("click", function () {
            let chosen_image = $($(".image-upload").next("[type=file]"))[0]
                .files[0];

            if (chosen_image && chosen_image !== "") {
                let chosen_image_path = URL.createObjectURL(
                    $($(".image-upload").next("[type=file]"))[0].files[0]
                );
                $(".image-uploaded").attr("src", chosen_image_path);
                $($(this).closest("div.modal")[0]).modal("hide");
            } else {
                _systemAlert("warning", "Please choose new image!");
            }
        });

        $("#btn-reset-photo").off();
        $("#btn-reset-photo").on("click", function () {
            $(".image-upload").attr("src", current_image);
            $($(this).closest("div.modal")[0]).modal("hide");
        });
    }

    if ($("[data-toggle=mode]").length) {
        $("[data-toggle=mode]").on("click", function () {
            let mode = "";
            let toggle = $($(this).find("i")[0]).attr("class");

            mode = toggle.indexOf("fas") > -1 ? "dark" : "light";
            ajaxRequest("/execute/settings", { theme_mode: mode });
        });
    }
});

function ajaxRequest(sUrl = "", sData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sData,
        beforeSend: function () {
            $(".div-loader").show();
        },
        success: function (result) {
            $(".div-loader").hide();
            console.log(result);
            eval(result.js);
        },
        error: function (e) {
            $(".div-loader").hide();
            _confirm(
                "alert",
                "Cannot continue, please call system administrator!"
            );
        },
    });
}

function ajaxSubmit(sUrl = "", sFormData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sFormData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(".div-loader").show();
        },
        success: function (result) {
            $(".div-loader").hide();
            console.log(result);
            eval(result.js);
        },
        error: function (e) {
            console.log(e);
            $(".div-loader").hide();
            _confirm(
                "alert",
                "Cannot continue, please call system administrator!"
            );
        },
    });
}

function _checkFormFields(parentForm) {
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find("input, textarea, select");

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];
        var sValue = $(sElement).val();
        var sData = $(sElement).attr("data");

        if ($(sElement).is(":visible")) {
            if (sData != "exclude") {
                if (sData == "req") {
                    if (sValue == "") {
                        $(sElement).addClass(" is-invalid ");
                        nEmpty++;
                    } else {
                        $(sElement).removeClass(" is-invalid ");
                    }
                }
            }
        }
    }

    if (nEmpty > 0) return false;
    else return true;
}

function _collectFields(parentForm) {
    var sJsonFields = {};
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find(
        "input:not(:checkbox):not(:radio), textarea, select"
    );

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];

        var sDataKey = $(sElement).attr("data-key");
        var sValue = $(sElement).val();

        if ($(sElement).is(":visible") === true) {
            if (sDataKey) {
                sJsonFields[sDataKey] = sValue;
            }
        }
    }

    return JSON.stringify(sJsonFields);
}

function _systemAlert(type, message) {
    let color = "";
    let icon = "";
    let title = "";

    switch (type) {
        case "alert":
            color = "red";
            icon = "fa fa-exclamation";
            title = "System Alert";
            break;

        case "warning":
            color = "orange";
            icon = "fa fa-exclamation";
            title = "System Alert";
            break;

        case "info":
            color = "green";
            icon = "fas fa-info-circle";
            title = "System Notification";
            break;
    }

    $.alert({
        title: title,
        icon: icon,
        type: color,
        theme: theme,
        content: message,
        buttons: {
            confirm: {
                text: "Okay",
                btnClass: "btn btn-primary",
            },
        },
    });
}

function _confirmAdd(content, url) {
    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fas fa-info-circle",
        type: "green",
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: theme,
        buttons: {
            confirm: {
                text: "Add More",
                btnClass: "btn btn-primary",
                action: function () {
                    location.reload();
                },
            },
            moreButtons: {
                text: "Back to List",
                btnClass: "btn-red",
                action: function () {
                    location = url;
                },
            },
        },
    });
}

function _confirmUpdate(content, url) {
    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fas fa-info-circle",
        type: "green",
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: theme,
        buttons: {
            confirm: {
                text: "Ok",
                btnClass: "btn btn-primary",
                action: function () {
                    location = url;
                },
            },
        },
    });
}

function _confirm(type, content) {
    let color = "";

    switch (type) {
        case "alert":
            color = "red";
            break;

        case "info":
            color = "green";
            break;

        case "confirm":
            color = "warning";
            break;
    }

    $.confirm({
        title: "System Notification",
        content: content,
        icon: "fa fa-exclamation",
        type: color,
        animation: "scale",
        closeAnimation: "scale",
        opacity: 0.5,
        theme: theme,
        buttons: {
            confirm: {
                text: "Ok",
                btnClass: "btn btn-primary",
                // action: function () {
                //     _conTinue(sAction, sJsonData);
                // },
            },
            // moreButtons: {
            //     text: "No",
            //     btnClass: "btn-red",
            //     // action: function () {},
            // },
        },
    });
}

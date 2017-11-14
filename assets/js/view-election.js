/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$("#party-div, #lg-div, #ra-div, #pu-div, #votes-div, #button-div").hide();

if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
    CKEDITOR.tools.enableHtml5Elements(document);

// The trick to keep the editor in the sample quite small
// unless user specified own height.
CKEDITOR.config.height = 300;
CKEDITOR.config.width = 'auto';

var initEditor = (function () {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
            isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

    return function () {
        var editorElement = CKEDITOR.document.getById('editor');

        // :(((
        if (isBBCodeBuiltIn) {
            editorElement.setHtml(
                    'Hello world!\n\n' +
                    'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
                    );
        }

        // Depending on the wysiwygare plugin availability initialize classic or inline editor.
        if (wysiwygareaAvailable) {
            CKEDITOR.replace('description');
        } else {
            editorElement.setAttribute('contenteditable', 'true');
            CKEDITOR.inline('description');

            // TODO we can consider displaying some info box that
            // without wysiwygarea the classic editor may not work.
        }
    };

    function isWysiwygareaAvailable() {
        // If in development mode, then the wysiwygarea must be available.
        // Split REV into two strings so builder does not replace it :D.
        if (CKEDITOR.revision == ('%RE' + 'V%')) {
            return true;
        }

        return !!CKEDITOR.plugins.get('wysiwygarea');
    }
})();

initEditor();

var $table = $('#candidate-bootstrap-table');

function operateFormatter(value, row, index) {
    return [
        '<div class="table-icons">',
        '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
        '<i class="ti-close"></i>',
        '</a>',
        '</div>',
    ].join('');
}

$().ready(function () {
    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            console.log(row);

            var idArray = row.id.split('-');
            var partyId = idArray[0];
            var electionId = idArray[1];

            var type = "deleteCandidate";
            var valid = true;

            if (partyId === "" || electionId === "") {
                valid = false;
            }

            if (valid === false) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Fields Empty."

                }, {
                    type: 'danger',
                    timer: 500
                });
            } else {
                $.ajax({
                    url: "/assets/php/AsyncScript.php",
                    type: "POST",
                    data: {
                        partyId: partyId,
                        electionId: electionId,
                        type: type
                    },
                    dataType: "json",
                    beforeSend: function () {
                    },
                    success: function (response) {
                        $.notify({
                            icon: 'pe-7s-gift',
                            message: "Candidate Deleted"
                        }, {
                            type: 'success',
                            timer: 500
                        });

                        //location.reload(true);
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $.notify({
                            icon: 'pe-7s-gift',
                            message: thrownError

                        }, {
                            type: 'danger',
                            timer: 500
                        });
                    }
                });
            }
        }
    };

    $table.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: true,
        showRefresh: true,
        search: true,
        showToggle: true,
        showColumns: true,
        pagination: true,
        searchAlign: 'left',
        pageSize: 8,
        pageList: [8, 10, 25, 50, 100],
        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            //do nothing here, we don't want to show the text "showing x of y from..."
        },
        formatRecordsPerPage: function (pageNumber) {
            return pageNumber + " rows visible";
        },
        icons: {
            refresh: 'fa fa-refresh',
            toggle: 'fa fa-th-list',
            columns: 'fa fa-columns',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'ti-close'
        }
    });

    //activate the tooltips after the data table is initialized
    $('[rel="tooltip"]').tooltip();

    $(window).resize(function () {
        $table.bootstrapTable('resetView');
    });
});

$("#addCandidateBtn").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var partyId = $("#party").val();
    var electionId = $("#electionId").val();
    var aspirant = $("#aspirant").val();
    var deputy = $("#deputy").val();
    var gender = $("#gender").val();
    var age = $("#age").val();
    var qualification = $("#qualification").val();

    var type = "addCandidate";
    var valid = true;

    if (partyId === "" || electionId === "" || aspirant === "" ||
            deputy === "" || gender === "" || age === "" ||
            qualification === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Fields Empty."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                partyId: partyId,
                electionId: electionId,
                aspirant: aspirant,
                deputy: deputy,
                gender: gender,
                age: age,
                qualification: qualification,
                type: type
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Candidate Added"
                }, {
                    type: 'success',
                    timer: 500
                });

                location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$("#addUpdateBtn").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var electionId = $("#electionId").val();
    var title = $("#title").val();
    var description = CKEDITOR.instances.description.getData();

    var type = "addUpdate";
    var valid = true;

    if (electionId === "" || title === "" || description === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Fields Empty."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                electionId: electionId,
                title: title,
                description: description,
                type: type
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Update Added"
                }, {
                    type: 'success',
                    timer: 500
                });

                location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$(".delete-update").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var electionId = $("#electionId").val();
    var allId = this.id;
    var idArray = allId.split('-');
    var updateId = idArray[1];

    var type = "deleteUpdate";
    var valid = true;

    if (electionId === "" || updateId === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Fields Empty."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                electionId: electionId,
                updateId: updateId,
                type: type
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Update Deleted"
                }, {
                    type: 'success',
                    timer: 500
                });

                location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$("#localg").on("change", function () {
    //clear options of select element
    $("#ra").empty();
    $("#pu").empty();
    var localGovId = $(this).val();
    var type = "getRAs";
    var valid = true;

    if (localGovId === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Something is wrong."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {localGovId: localGovId, type: type},
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $("<option>Select</option>").appendTo("#pu");
                for (i = 0; i < response.length; i++) {
                    $("<option value='" + response[i].id + "'>" + response[i].name + "</option>").appendTo("#ra");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$("#ra").on("change", function () {
    //clear options of select element
    $("#pu").empty();

    var raId = $(this).val();
    var type = "getPUs";
    var valid = true;

    if (raId === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Something is wrong."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {raId: raId, type: type},
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $("<option>Select</option>").appendTo("#pu");

                for (i = 0; i < response.length; i++) {
                    $("<option value='" + response[i].id + "'>" + response[i].code + "</option>").appendTo("#pu");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$('input[type=radio][name=resultLevel]').change(function () {
    if (this.value === 'level-pu') {
        $("#party-div, #lg-div, #ra-div, #pu-div, #votes-div, #button-div").show();
    } else if (this.value === 'level-ra') {
        $("#pu-div").hide();
        $("#party-div, #lg-div, #ra-div, #votes-div, #button-div").show();
    } else if (this.value === 'level-lg') {
        $("#pu-div, #ra-div").hide();
        $("#party-div, #lg-div, #votes-div, #button-div").show();
    }
});

$("#addResultBtn").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var resultLevel = $('input[name=resultLevel]:checked', '#addResultForm').val();
    var partyId = $("#party-result").val();
    var electionId = $("#electionId").val();
    var votes = $("#votes").val();
    var type;
    var levelId;
    var datas;

    var valid = true;

    if (resultLevel === 'level-pu') {
        levelId = $("#pu").val();
        type = "addResultPU";
        //datas = {"partyId": partyId, "electionId": electionId, "puId": puId, "votes": votes};
    } else if (resultLevel === 'level-ra') {
        levelId = $("#ra").val();
        type = "addResultRA";
        //datas = {"partyId": partyId, "electionId": electionId, "raId": raId, "votes": votes};
    } else if (resultLevel === 'level-lg') {
        levelId = $("#localg").val();
        type = "addResultLG";
        //datas = {"partyId": partyId, "electionId": electionId, "localGovId": lgId, "votes": votes};
    }

    if (partyId === "" || electionId === "" || votes === "" || levelId === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Some Required Fields Are Empty."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                partyId: partyId,
                electionId: electionId,
                levelId: levelId,
                votes: votes,
                type: type
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Result Entered"
                }, {
                    type: 'success',
                    timer: 500
                });

                location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

$("#addElectionBtn").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var electionId = $("#electionId").val();
    var title = $("#e-title").val();
    var regVoters = $("#regVoters").val();
    var acrVoters = $("#acrVoters").val();
    var votesCast = $("#votesCast").val();
    var validVotes = $("#validVotes").val();
    var rejVotes = $("#rejVotes").val();
    var date = $("#e-date").val();
    var hashtag = $("#hashtag").val();

    var type = "updateElection";
    var valid = true;

    if (electionId === "" || title === "" || date === "") {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Some Required Fields Are Empty."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                electionId: electionId,
                title: title,
                regVoters: regVoters,
                acrVoters: acrVoters,
                votesCast: votesCast,
                validVotes: validVotes,
                rejVotes: rejVotes,
                date: date,
                hashtag: hashtag,
                type: type
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Election Added"
                }, {
                    type: 'success',
                    timer: 500
                });

                location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});


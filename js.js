$(document).ready(function() {
    var sessionUserData = sessionStorage.getItem("user");
    if(sessionUserData === null) window.location.href = 'http://www.oneindiawallet.com/page-login.html'
    getCardLimit();
  var form = $("#form"),
    befName = $("#befName"),
    beneMobNo = $("#beneMobNo"),
    bankName = $("#bankName"),
    ifsc = $("#ifsc"),
    beneAccNo = $("#beneAccNo"),
    rebeneAccNo = $("#rebeneAccNo"),
    branchName = $("#branchName"),
    aadharCard = $("#aadharCard"),
    address = $("#address"),
    submit = $("#submit");

    form.on("befName", "#beneMobNo, #beneMobNo, #bankName", "ifsc", "beneAccNo", "rebeneAccNo", "branchName", "aadharCard", "address", function() {
        $(this).css("border-color", "");
        info.html("").slideUp();
    });

    submit.on("click", function(e) {
    e.preventDefault();
    if (true) {
        var sessionData = sessionStorage.getItem("user");
        const agentId = sessionData ? JSON.parse(sessionData).agent_id : null
        $.ajax({
        type: "POST",
        url: "payment.php",
        data: agentId ? form.serialize()+'&reference1='+agentId + '&userId='+ JSON.parse(sessionData).id: form.serialize(),
        dataType: "json"
        }).done(function(data) {
        if (data.success) {
            $(".meesageText").removeClass("d-none");
            $(".meesageText").html(data.data.messageText);
            setTimeout(() => {
                $(".meesageText").addClass("d-none");
            }, 5000);
            $(".screen1").removeClass("d-none");
            $(".screen2").addClass("d-none");
        } else {
            
        }
        });
    }
    });
    $("#nextScreen1").click(function () {
        $(".screen1").addClass("d-none");
        $(".screen2").removeClass("d-none");
    });
    $("#checkIfsc").click(function () {
        $.ajax({
            type: "POST",
            url: "checkIfsc.php",
            data: 'ifsc='+ $(ifsc).val(),
        }).done(function(data) {
            var result = JSON.parse(data);
            if (result.success) {
                var branch = result.data.data.bankname;
            $("#bankName").val(branch);
            } else {
                console.log('error');
            }
        });
    });

    function validate() {
        var valid = true;
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email.val())) {
        email.css("border-color", "red");
        valid = false;
        }
        if ($.trim(subject.val()) === "") {
        subject.css("border-color", "red");
        valid = false;
        }
        if ($.trim(message.val()) === "") {
        message.css("border-color", "red");
        valid = false;
        }

        return valid;
    }
});

function getCardLimit() {
    $.ajax({
        type: "POST",
        url: "customerLimit.php",
        data: 'ifsc='+ $("#ifsc").val(),
    }).done(function(data) {
        if (JSON.parse(data).success) {
        $(".cardLimit").html(JSON.parse(data).data.mpt);
        } else {
            console.log('error');
        }
    });
}

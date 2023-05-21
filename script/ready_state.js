$(document).ready(function () {
  $(".btnSignIn").on("click", function () {
    $("#modalSignIn").modal("show");
  });
  $(":input").prop("autocomplete", "off");

  $(".btnSignUp").on("click", function () {
    $("#modalSignUp").modal("show");
  });

  $("#password,#confirmpassword").on("keyup", function () {
    if ($("#password").val() == $("#confirmpassword").val()) {
      $("#icon-message").removeAttr("class");
      $("#icon-message").addClass("fa fa-check-circle px-2");
      $("#icon-message").css("color", "green");
      $(':input[type="submit"]').removeAttr("disabled");
    } else {
      $("#icon-message").removeAttr("class");
      $("#icon-message").addClass("fa fa-xmark-circle px-2");
      $("#icon-message").css("color", "red");
      $(':input[type="submit"]').prop("disabled", true);
    }
  });
});

function Pay() {
  var address = $("#input_address").val();
  if (address == "") {
    $("#ConfirmPay").modal("hide");
    console.log($("#ConfirmPay"));
    alert("Please enter address");
    document.getElementById("input_address").focus();
    return;
  }
  $(".toast").toast("show");
  setTimeout(() => {
    window.location = "cart.php?action=pay&address=" + address;
  }, 3000);
}

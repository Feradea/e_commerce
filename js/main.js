var signUpMsgArea = document.getElementById("signUpMsgArea");
var signUpMsg = document.getElementById("signUpMsg");

var signInMsgArea = document.getElementById("signInMsgArea");
var signInMsg = document.getElementById("signInMsg");

/*Clear Register fields*/
// function signUp_clear(){

//     document.getElementById("signUpInputFirstName").value = "";
//     document.getElementById("signUpInputLastName").value = "";
//     document.getElementById("signUpInputEmail").value = "";
//     document.getElementById("signUpInputPassword").value = "";
//     signUpMsg.value = "";
//     signUpMsgArea.style.display = "none";
// }


/*Register function*/
function signUp() {
  var params = $("#signUpForm").serialize();

  console.log("Params: " + params);

  $.ajax({
    type: "POST",
    url: "validators/signUpValidator.php",
    data: params,
    async: true,
    cache: false,
    success: function(data) {
      var json = eval(data);

      if (json["success"] == "true") {
        signUpMsg.classList.remove("alert-danger");
        signUpMsg.classList.add("alert-success");
      } else {
        signUpMsg.classList.remove("alert-success");
        signUpMsg.classList.add("alert-danger");
      }

      signUpMsg.innerHTML = json["error"];
      signUpMsg.style.display = "block";
      signUpMsgArea.style.display = "block";
    },
    error: function(xhr, status, error) {
      console.log("error " + xhr + "\n" + status + "\n" + error);
    }
  });
}

/*Login function*/
function signIn() {
  var params = $("#signInForm").serialize();

  console.log("Params: " + params);

  $.ajax({
    type: "POST",
    url: "validators/signInValidator.php",
    data: params,
    async: true,
    cache: false,
    success: function(data) {
      var json = eval(data);

      if (json["success"] == "true") {
        signInMsg.classList.remove("alert-danger");
        signInMsg.classList.add("alert-success");
        window.location = "index.php";
        signIn_clear();
      } else {
        signInMsg.classList.add("alert-danger");
        signInMsg.innerHTML = json["error"];
        signInMsg.style.display = "block";
        signInMsgArea.style.display = "block";
      }

    },
    error: function(xhr, status, error) {
      console.log("error " + xhr + "\n" + status + "\n" + error);

    }
  });
}

/*Clear Login fields*/
function signIn_clear() {
    document.getElementById("signInInputEmail").value = "";
    document.getElementById("signInInputPassword").value = "";
    signInMsg.value = "";
    signInMsgArea.style.display = "none";
  }

/*Forgot Pass function*/
function forgotPass() {
  var params = $("form.forgotPassForm").serialize();

  $.ajax({
    type: "POST",
    url: "validators/forgotPassValidator.php",
    data: params,
    async: true,
    cache: false,
    success: function(data) {
      var json = eval(data);

      if (json["success"] == "true") {
        forgotPassMsg.classList.remove("alert-danger");
        forgotPassMsg.classList.add("alert-success");
      } else {
        forgotPassMsg.classList.remove("alert-success");
        forgotPassMsg.classList.add("alert-danger");
      }

      forgotPassMsg.innerHTML = json["error"];
      forgotPassMsg.style.display = "block";
      forgotPassMsgArea.style.display = "block";
    },
    error: function(xhr, status, error) {
      console.log("error " + xhr + "\n" + status + "\n" + error);
    }
  });
}

window.addEventListener("load", function() {
  $("button#signUpSubmit").click(function(event) {
    event.preventDefault();
    signUp();
    console.log("Register");

    // window.setTimeout(function(){location.reload()},8000);
  });

//   if ($("#signInForm") != null) {
//     $("#signInForm").submit(function(event) {
//       event.preventDefault();
//       signIn();
//       console.log("Login");

//       // window.setTimeout(function(){location.reload()},8000);
//     });
//   }

  $("button#signInSubmit").click(function (event) {
      event.preventDefault();
      signIn();
      console.log("Login2");

      // window.setTimeout(function(){location.reload()},8000);
  });

  $("button#forgotPassSubmit").click(function(event) {
    event.preventDefault();
    forgotPass();
  });
});

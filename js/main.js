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

/*Add to Cart function*/
// function  addToCart() {
//     var params = $("#addToCartForm").serialize();
  
//     console.log("Params: " + params);
  
//     $.ajax({
//       type: "POST",
//       url: "validators/order.php",
//       data: params,
//       async: true,
//       cache: false,
//       success: function(data) {
//         var json = eval(data);
  
//         if (json["success"] == "true") {
//           console.log("stage1");
//         } else {
//             console.log("stage2");
//         }
  
//         console.log("stage3");
//       },
//       error: function(xhr, status, error) {
//         console.log("error " + xhr + "\n" + status + "\n" + error);
//       }
//     });
//   }


// 

$(document).ready(function() {
  $('form#addUserForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#addUserForm');

    _this.validate({
      rules: {
        password: "required",
        password_again: {
          equalTo: "#password"
        }
    }});

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/user/controllers/add.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.exists) {
            $.notify({ message: 'User already exists!' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
          if (res.success) {
            $.notify({ message: 'User created successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?user_settings=add";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#editUserForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#editUserForm');

    _this.validate({
      rules: {
        password_again: {
          equalTo: "#password"
        }
    }});

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/user/controllers/edit.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'User updated successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?user_settings=edit";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#deleteUserForm').on('submit', function(e) {
    e.preventDefault();
    if(confirm("Do you really want to delete this user?")) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/user/controllers/delete.php",
        data: $('form#deleteUserForm').serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'User successfully deleted!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?user_settings=delete";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#deleteProductForm').on('submit', function(e) {
    e.preventDefault();
    if(confirm("Do you really want to delete this product?")) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/product/controllers/delete.php",
        data: $('form#deleteProductForm').serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Product successfully deleted!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?product_settings=delete";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#deleteBrandForm').on('submit', function(e) {
    e.preventDefault();
    if(confirm("Do you really want to delete this brand?")) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/brand/controllers/delete.php",
        data: $('form#deleteBrandForm').serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Brand successfully deleted!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?brand_settings=delete";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#deleteCategoryForm').on('submit', function(e) {
    e.preventDefault();
    if(confirm("Do you really want to delete this category?")) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/category/controllers/delete.php",
        data: $('form#deleteCategoryForm').serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Category successfully deleted!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?category_settings=delete";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#addBrandForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#addBrandForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/brand/controllers/add.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Brand created successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?brand_settings=add";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#editBrandForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#editBrandForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/brand/controllers/edit.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Brand edited successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?brand_settings=edit";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#addCategoryForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#addCategoryForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/category/controllers/add.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Category created successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?category_settings=add";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#editCategoryForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#editCategoryForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/category/controllers/edit.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Category edited successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?category_settings=edit";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#editProductForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#editProductForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/product/controllers/edit.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Product edited successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?product_settings=edit";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });

  $('form#addProductForm').on('submit', function(e) {
    e.preventDefault();
    let _this = $('form#addProductForm');

    _this.validate();

    if (_this.valid()) {
      $.ajax({
        type: "POST",
        url: "components/in/admin/product/controllers/add.php",
        data: _this.serializeArray(),
        async: true,
        cache: false,
        success: function(data) {
          let res = JSON.parse(data);
          if (res.success) {
            $.notify({ message: 'Product created successfully!' },{ type: 'success', placement: { from: "bottom", align: "right" },});
            window.location = "index.php?product_settings=edit";
          } else {
            $.notify({ message: 'Something went wrong..' },{ type: 'danger', placement: { from: "bottom", align: "right" },});
          }
        },
        error: function(xhr, status, error) {
          console.log("error " + xhr + "\n" + status + "\n" + error);
        }
      });
    }
  });
});




window.addEventListener("load", function() {
    $("button#signUpSubmit").click(function(event) {
      event.preventDefault();
      signUp();
      console.log("Register");
  
      // window.setTimeout(function(){location.reload()},8000);
    });
  
  
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

    // $("button#addToCartSubmit").click(function (event) {
    //     event.preventDefault();
    //     addToCart();
    //     console.log("AddToCart");

    // });

  });
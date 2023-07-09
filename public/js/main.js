$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

function readURL(input) {
  if (input.files && input.files[0]) {
    $.each(input.files, function (key, value) {
      // data = {key:key, value : input.files[key].name};
      // $.ajax({
      //     type:'POST',
      //     url:'/temp/img-add',
      //     data:data,
      //     success:function(status) {
      //         console.log(status);
      //     },
      //     error: function (msg) {
      //        console.log(msg);
      //     }
      //  });

      var reader = new FileReader();
      reader.onload = function (e) {
        var d =
          '<div class="col-sm-2 col-xs-2 col-md-2 imagePreview"><img src="' +
          e.target.result +
          '"/ ></div>';
        $(".member-preview").append($.parseHTML(d));

        // $('#img-delete'+key).click(function(){
        //     $(this).parent(".imagePreview").remove();
        //     $.ajax({
        //         type:'POST',
        //         url:'/temp/img-delete',
        //         data:{id:key},
        //         success:function(status) {
        //             console.log(status);
        //         },
        //         error: function (msg) {
        //         console.log(msg);
        //         }
        //     });
        // });
      };
      reader.readAsDataURL(input.files[key]);
    });
  }
}

$(".img-delete").click(function () {
  $(this).parent(".imagePreview").remove();
  var id = $(this).attr("data-id");
  $.ajax({
    type: "POST",
    url: "/properties/img-delete",
    data: { id: id },
    success: function (status) {
      console.log(status);
    },
    error: function (msg) {
      console.log(msg);
    },
  });
});

$("#inputImage").change(function () {
  $(".member-preview").empty();
  readURL(this);
});

$(document).ready(function () {
  // $(".dataTable").DataTable();

  $("#division-dropdown").on("change", function () {
    var idDivision = this.value;
    // console.log(idDivision);
    $("#township-dropdown").html("");
    $.ajax({
      url: "/get-townshipbydivision/",
      type: "GET",
      data: {
        division_id: idDivision,
      },
      success: function (result) {
        $("#township-dropdown").html('<option value="">Choose...</option>');
        $.each(result, function (key, value) {
          $("#township-dropdown").append(
            '<option value="' + value.id + '">' + value.township + "</option>"
          );
        });
        $("#ward-dropdown").html('<option value="">Choose...</option>');
      },
    });
  });

  $("#township-dropdown").on("change", function () {
    var idTownship = this.value;
    // console.log(idDivision);
    $("#ward-dropdown").html("");
    $.ajax({
      url: "/get-wardbytownship/",
      type: "GET",
      data: {
        township_id: idTownship,
      },
      success: function (result) {
        $("#ward-dropdown").html('<option value="">Choose...</option>');
        $.each(result, function (key, value) {
          $("#ward-dropdown").append(
            '<option value="' + value.id + '">' + value.ward + "</option>"
          );
        });
      },
    });
  });
});

var deleteButtons = document.querySelectorAll(".img-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;

    // Remove the list item from the DOM
    listItem.remove();

    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
      type: "POST",
      url: "/properties/img-delete",
      data: { id: id },
      success: function (status) {
        console.log(status);
      },
      error: function (msg) {
        console.log(msg);
      },
    });
  });
});

var deleteButtons = document.querySelectorAll(".doc-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;

    // Remove the list item from the DOM
    listItem.remove();

    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
      type: "POST",
      url: "/properties/doc-delete",
      data: { id: id },
      success: function (status) {
        console.log(status);
      },
      error: function (msg) {
        console.log(msg);
      },
    });
  });
});
//for rent property
var deleteButtons = document.querySelectorAll(".rent-img-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;

    // Remove the list item from the DOM
    listItem.remove();

    var id = $(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: "/property-rent/img-delete",
      data: { id: id },
      success: function (status) {
        console.log(status);
      },
      error: function (msg) {
        console.log(msg);
      },
    });
  });
});

var deleteButtons = document.querySelectorAll(".rent-doc-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;

    // Remove the list item from the DOM
    listItem.remove();

    var id = $(this).attr("data-id");
    console.log(id);
    $.ajax({
      type: "POST",
      url: "/property-rent/doc-delete",
      data: { id: id },
      success: function (status) {
        console.log(status);
      },
      error: function (msg) {
        console.log(msg);
      },
    });
  });
});

$("#front-area").focusout(function () {
  calculateAreaAcre();
});

$("#side-area").focusout(function () {
  calculateAreaAcre();
});

function calculateAreaAcre() {
  var front_area = parseFloat($("#front-area").val());
  var side_area = parseFloat($("#side-area").val());
  var square_feet = front_area * side_area;
  var acre = square_feet / 43560;
  $("#square-feet").val(square_feet);
  $("#acre").val(acre.toFixed(3));
}

// zoom Image
$(".showImage").click(function () {
  var imageSrc = $(this).attr("src");
  console.log(imageSrc);
  $("#zoomed-image").attr("src", imageSrc);
  $("#zoom-modal").modal("show");
});

$(".featurePhotoBox img").click(function () {
  var imageSrc = $(this).attr("src");
  console.log(imageSrc);
  $("#zoomed-image").attr("src", imageSrc);
  $("#zoom-modal").modal("show");
});

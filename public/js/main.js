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
  $("#kt_table_widget_1").DataTable();

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

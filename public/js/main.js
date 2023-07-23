$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

$("#table_id").DataTable({
  lengthChange: false, // Disable "Show entries"
  dom:'<"top"i>rt<"bottom"lp><"clear">'
});

$('#floor').selectpicker();

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
    Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
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
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly        
      }
    });
  });
});

var deleteButtons = document.querySelectorAll(".doc-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;
    Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
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
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly        
      }
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
    Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
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
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly        
      }
    });
  });
});

var deleteButtons = document.querySelectorAll(".rent-doc-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;
    Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // Remove the list item from the DOM
        listItem.remove();
        var id = $(this).attr("data-id");
        $.ajax({
          type: "POST",
          url: "/property-rent/doc-delete",
          data: { id: id },
          success: function (status) {
            console.log(status);
          },
          error: function (msg) {
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly        
      }
    });    
  });
});

//contract doc delete in invoice edit
var deleteButtons = document.querySelectorAll(".contract-doc-delete-icon");
// Attach event listener to each delete button
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the parent element (list item) of the button
    var listItem = this.parentNode;
    Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // Remove the list item from the DOM
        listItem.remove();
        var id = $(this).attr("data-id");
        $.ajax({
          type: "POST",
          url: "/invoices/doc-delete",
          data: { id: id },
          success: function (status) {
            console.log(status);
          },
          error: function (msg) {
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly        
      }
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

$('#agent-fee').on('focusout', function () {
  calculateTotal();
});
$('#discount').on('focusout', function () {
  calculateTotal();
});
$('#tax').on('focusout', function () {
  calculateTotal();
});

$('#partner-fee').on('focusout', function () {
  calculateAgencyNetAmt();
});

$('#total').on('focusout', function () {
  calculateAgencyNetAmt();
});

$('#property').on('change', function () {
  var property_id = $(this).val();
  var type = $('#invtype').val();
  $.ajax({
    type: "POST",
    url: '/get-property-detail/',
    data: {
      property_id,
      type
    },
    success: function (result) { 
      console.log('result', result);
      $('#deal-price').val(result.price);
    },
    error: function (msg) {
      console.log(msg);
    },
  });  
});

function ConfirmDialog(delete_route,id) {
  Swal.fire({
      title: 'Are you sure want to delete?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: delete_route,
          data: {'id':id},
          success: function (status) {          
            location.reload();
          },
          error: function (msg) {
            Swal.fire(
              'Error!',
              'An error occurred while deleting the item.',
              'error'
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User cancelled, do nothing or handle accordingly
        
      }
    });
};

function calculateTotal() {
  var agent_fee = $('#agent-fee').val();
  var discount = $('#discount').val();
  var tax = $('#tax').val();
  var total = agent_fee - discount - tax ;
  $('#total').val(total);
}

function calculateAgencyNetAmt() {
  var total = $('#total').val();
  var partner_fee = $('#partner-fee').val();
  var agency_net_amt = total - partner_fee;
  $('#agency-net-amt').val(agency_net_amt);
}
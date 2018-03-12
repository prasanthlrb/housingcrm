 var action = $( '#product_form' ).attr( 'action' );
 var action2 = $( '#product_form2' ).attr( 'action' );
$('#add').click(function(){
    save_method = 'add';
    $('#product-model').modal('show');
    $('.modal-title').text('Add Data');
    $('.save-type').text('Save');
    $("#product_form")[0].reset();
});
$('#add_sec').click(function(){
    save_method = 'add';
    $('#product-model2').modal('show');
    $('.modal-title').text('Add Data');
    $('.save-type').text('Save');
    $("#product_form")[0].reset();
});

function save(){
  var formData = new FormData($('#product_form')[0]);
  $.ajax({
          url : action,
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
              $("#product_form")[0].reset();
              $('#product-model').modal('hide');
              $('.product_item').load(location.href+' .product_item');
          }
      });

}
function save2(){
  var formData = new FormData($('#product_form2')[0]);
  $.ajax({
          url : action2,
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
              $("#product_form")[0].reset();
              $('#product-model2').modal('hide');
              $('.product_item').load(location.href+' .product_item');
          }
      });

}

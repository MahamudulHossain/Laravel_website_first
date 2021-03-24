@extends('Layout.app')
@section('content')
@section('title','Admin Panel- Image Upload')

<div class="container">
<div class="row">
<div class="col-md-8 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addImageBtn">Add New</button>
</div>
</div>
</div>

<div class="container">
<div class="row photoRow">

</div>
<center><button class="btn btn-success text-center" id="loadMoreBtn">Load More</button></center>
</div>


<div class="modal fade" id="addImagesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-2">
          <h4>Upload Image</h4>
          <form id="projectFrm">
          <input type="file" id="uploadImage" class="form-control mb-4"/>
          <img  class="image_upload" src="images/img.png" >
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="uploadImageConfirmBtn" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('style')

<script type="text/javascript">
  loadingImages();
  $('#addImageBtn').click(function(){
    $('#addImagesModal').modal('show');
    $('#uploadImage').change(function(){
      var reader = new FileReader();
      reader.readAsDataURL(this.files[0]);
      reader.onload = function(event) {
        var ImagePath = event.target.result;
        $('.image_upload').attr('src',ImagePath);
   };
    });
  });

  $('#uploadImageConfirmBtn').click(function(){
    var photoFile = $('#uploadImage').prop('files')[0];
    var formData = new FormData();
    formData.append('photo',photoFile);
    $(this).html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
    axios.post('/uploadPhoto',formData)
      .then(function(response){
        if(response.status == 200 && response.data == 1){
          $('#uploadImageConfirmBtn').html('Save');
          toastr.success('Uploaded Successfully');
          $('#addImagesModal').modal('hide');
          window.location.href = window.location.href;
        }else{
          $('#uploadImageConfirmBtn').html('Save');
          toastr.error('Upload Failed');
          $('#addImagesModal').modal('hide');
        }
      })
        .catch(function(error){
          $('#uploadImageConfirmBtn').html('Save');
          toastr.error('Upload Failed');
          $('#addImagesModal').modal('hide');
        })
  });

  function loadingImages(){
    axios.get('/getPhotos')
        .then(function(response){
          if(response.status == 200){
              var jsonData = response.data;
              $.each(jsonData, function(i, item) {
                  $("<div class='col-md-3 p-1' id='loadingImagesDiv'>").html(
                      "<img data-id='"+jsonData[i].id+"' class='image_upload_row m-2' src='"+jsonData[i].ImagePath+"'>"+
                      "<input type='text' id='copy_txt_"+jsonData[i].id+"' value='"+jsonData[i].ImagePath+"' readonly>"+
                      "<input type='button' id='copy_"+jsonData[i].id+"' class='btn btn-sm' value='Copy'>"
                  ).appendTo('.photoRow');
                  $('#copy_'+jsonData[i].id).click(function(){
                    /* Get the text field */
                    var copyText = document.getElementById("copy_txt_"+jsonData[i].id);

                    /* Select the text field */
                    copyText.select();

                    /* Copy the text inside the text field */
                    document.execCommand("copy");
                                    });
                });
          }else{

          }
        })
            .catch(function(error){

            })
  }
    var i=0;
    function loadImage(image_ID){
      i = i+4;
      var img_id = image_ID+i;
      axios.get('/loadMorePhotos/'+img_id)
          .then(function(response){
            if(response.status == 200){
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $("<div class='col-md-3 p-1' id='loadingImagesDiv'>").html(
                        "<img data-id='"+jsonData[i].id+"' class='image_upload_row m-2' src='"+jsonData[i].ImagePath+"'>"+
                        "<input type='text' id='copy_txt_"+jsonData[i].id+"' value='"+jsonData[i].ImagePath+"' readonly>"+
                        "<input type='button' id='copy_"+jsonData[i].id+"' class='btn btn-sm' value='Copy'>"
                    ).appendTo('.photoRow');
                    $('#copy_'+jsonData[i].id).click(function(){
                      /* Get the text field */
                      var copyText = document.getElementById("copy_txt_"+jsonData[i].id);

                      /* Select the text field */
                      copyText.select();

                      /* Copy the text inside the text field */
                      document.execCommand("copy");
                                      });
                  });
            }else{

            }
          })
              .catch(function(error){

              })

    }
    $('#loadMoreBtn').click(function(){
      var image_ID = $(this).closest('div').find('img').data('id');
      loadImage(image_ID);
    });

</script>

@endsection

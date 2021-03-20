@extends('Layout.app')
@section('content')
@section('title','Admin Panel- Image Upload')

<div class="container " id="dataDivProjects">
<div class="row">
<div class="col-md-8 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addImageBtn">Add New</button>
</div>
</div>
</div>

<div class="container d-none" id="wrongDivImageUpload">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
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
    axios.post('/uploadPhoto',formData)
      .then(function(response){
        if(response.status == 200 && response.data == 1){
          $('#addImagesModal').modal('hide');
        }
      })
        .catch(function(error){
          alert(error);
        })
  });




</script>

@endsection

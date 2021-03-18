@extends('Layout.app')
@section('content')

<div class="container d-none" id="dataDivReviews">
<div class="row">
<div class="col-md-12 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addReviewBtn">Add New</button>
<table id="ReviewDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Description</th>
    <th class="th-sm">Image</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='ReviewsData'>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container" id="loadingDivReviews">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img src="{{asset('images/4V0b.gif')}}" alt="">
</div>
</div>
</div>


<div class="container d-none" id="wrongDivReviews">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
</div>


<div class="modal fade" id="ReviewsDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-5">
        <h5>Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button type="button" id="ReviewsDeleteConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-4 mt-3">
        <div class="editReviewContent d-none">
          <input type="text" id="ReviewName" class="form-control mb-4" />
          <input type="text" id="ReviewDescription" class="form-control mb-4" />
          <input type="text" id="Review_Img_path" class="form-control mb-4" />
        </div>
        <img src="{{asset('images/4V0b.gif')}}" class="loadingReviewImg" style="height: 120px;">
        <h5 class="editReviewErrorMsg d-none">Something Went Wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="editReviewConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addReviewsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-2">
          <h4>Insert New Review</h4>
          <form id="ReviewFrm">
          <input type="text" id="addReviewName" class="form-control mb-4" placeholder="Review Name"/>
          <input type="text" id="addReviewDescription" class="form-control mb-4" placeholder="Review Description"/>
          <input type="text" id="add_Review_Img_path" class="form-control mb-4" placeholder="Review Image"/>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="addReviewConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('style')

<script type="text/javascript">

  loadReviewsData();

  function loadReviewsData() {
      axios.get('/getReviewsData')
          .then(function(response) {
              if (response.status == 200) {
                  $('#loadingDivReviews').addClass('d-none');
                  $('#dataDivReviews').removeClass('d-none');
                  var jsonData = response.data;
                  $('#ReviewDt').DataTable().destroy();
                  $('#ReviewsData').empty();
                  $.each(jsonData, function(i, item) {
                      $('<tr>').html(
                          "<th class='th-sm'>" + jsonData[i].name + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].desc + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].image + "</th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='ReviewsEditbtn'><i class='fas fa-edit'></i></a></th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='ReviewsDeletebtn'><i class='fas fa-trash-alt'></i></a></th>"
                      ).appendTo('#ReviewsData');
                    });
                    $('.ReviewsDeletebtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#ReviewsDeleteConfirmBtn').attr('data-id', id);
                        $('#ReviewsDeleteModal').modal('show');
                    });
                    $('.ReviewsEditbtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#editReviewConfirmBtn').attr('data-id', id);
                        EachEditReviewData(id);
                        $('#editReviewModal').modal('show');
                    });
                    $(document).ready(function() {
                        $('#ReviewDt').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    });
                  } else {
                      $('#loadingDivReviews').addClass('d-none');
                      $('#wrongDivReviews').removeClass('d-none');
                  }
              }).catch(function(error) {
                  $('#loadingDivReviews').addClass('d-none');
                  $('#wrongDivReviews').removeClass('d-none');
              });
  }

  $('#ReviewsDeleteConfirmBtn').click(function() {
      var id = $(this).attr('data-id');
      deleteReviewsData(id);
      loadReviewsData();
  });
  function deleteReviewsData(dataID) {
    $('#ReviewsDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
      axios.post('/deleteReviewsData', {
              id: dataID
          })
          .then(function(response) {
            $('#ReviewsDeleteConfirmBtn').html("Delete");
              if (response.data == 1) {
                  $('#ReviewsDeleteModal').modal('hide');
                  toastr.success('Deleted Successfully');
              } else {
                $('#ReviewsDeleteModal').modal('hide');
                toastr.error('Data Deletion Failed');
              }
          }).catch(function(error) {
            $('#ReviewsDeleteModal').modal('hide');
            toastr.error('Data Deletion Failed');
          });
  }

  //Edit Reviews

  function EachEditReviewData(dataID) {
      axios.post('/getEachReviewData', {
              id: dataID
          })
          .then(function(response) {
              if (response.status == 200) {
                $('.editReviewContent').removeClass('d-none');
                $('.loadingReviewImg').addClass('d-none');
                var jsonData = response.data;
                $('#ReviewName').val(jsonData[0].name);
                $('#ReviewDescription').val(jsonData[0].desc);
                $('#Review_Img_path').val(jsonData[0].image);
              } else {
                $('.loadingReviewImg').addClass('d-none');
                $('.editReviewErrorMsg').removeClass('d-none');
              }
          }).catch(function(error) {
            $('.loadingReviewImg').addClass('d-none');
            $('.editReviewErrorMsg').removeClass('d-none');
          });
  }

  $('#editReviewConfirmBtn').click(function() {
    var id = $(this).attr('data-id');
    var ReviewName = $('#ReviewName').val();
    var ReviewDescription = $('#ReviewDescription').val();
    var Review_Img_path = $('#Review_Img_path').val();
      updateReviewData(id,ReviewName,ReviewDescription,Review_Img_path);
      loadReviewsData();
  });
  function updateReviewData(dataID,ReviewName,ReviewDescription,Review_Img_path) {
          if(ReviewName.length == 0){
            toastr.error('Name can not be empty!');
          }
          else if (ReviewDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (Review_Img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#editReviewConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/updateReviewData', {
              id: dataID,
              ReviewName: ReviewName,
              ReviewDescription: ReviewDescription,
              Review_Img_path: Review_Img_path
                })
            .then(function(response) {
              $('#editReviewConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#editReviewModal').modal('hide');
                    toastr.success('Data Updated Successfully');
                } else {
                  $('#editReviewModal').modal('hide');
                  toastr.error('Data Updation Failed');
                }
            })
            .catch(function(error) {
              $('#editReviewModal').modal('hide');
              toastr.error('Data Updation Failed');
            });
          }
  }

  //Add New Review
  $('#addReviewBtn').click(function(){
    $('#addReviewsModal').modal('show');
  });
  $('#addReviewConfirmBtn').click(function() {
    var addReviewName = $('#addReviewName').val();
    var addReviewDescription = $('#addReviewDescription').val();
    var add_Review_Img_path = $('#add_Review_Img_path').val();
      addReviewData(addReviewName,addReviewDescription,add_Review_Img_path);
      document.getElementById("ReviewFrm").reset();
      loadReviewsData();

  });
  function addReviewData(addReviewName,addReviewDescription,add_Review_Img_path) {
          if(addReviewName.length == 0){
            toastr.error('Name can not be empty!');
          }
          else if (addReviewDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (add_Review_Img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#addReviewConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/addReviewsData', {
              addReviewName: addReviewName,
              addReviewDescription: addReviewDescription,
              add_Review_Img_path: add_Review_Img_path
                })
            .then(function(response) {
              $('#addReviewConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#addReviewsModal').modal('hide');
                    toastr.success('Data Inserted Successfully');
                } else {
                  $('#addReviewsModal').modal('hide');
                  toastr.error('Data Insertion Failed');
                }
            })
            .catch(function(error) {
              $('#addReviewsModals').modal('hide');
              toastr.error('Data Insertion Failed');
            });
          }
  }

</script>

@endsection

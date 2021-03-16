@extends('Layout.app')
@section('content')

<div class="container d-none" id="dataDiv">
<div class="row">
<div class="col-md-12 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addServicesBtn">Add New</button>
<table id="ServiceDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='servicesData'>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container" id="loadingDiv">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img src="{{asset('images/4V0b.gif')}}" alt="">
</div>
</div>
</div>


<div class="container d-none" id="wrongDiv">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-5">
        <h5>Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button type="button" id="deleteConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog p-4 ">
    <div class="modal-content">
      <div class="modal-body text-center p-4 mt-3">
        <div class="editContent d-none">
          <input type="text" id="title" class="form-control mb-4" />
          <input type="text" id="short_desc" class="form-control mb-4" />
          <input type="text" id="img_path" class="form-control mb-4" />
        </div>
        <img src="{{asset('images/4V0b.gif')}}" id="loadingImg" style="height: 120px;">
        <h5 class="editErrorMsg d-none">Something Went Wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="editConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog p-4 ">
    <div class="modal-content">
      <div class="modal-body text-center p-4 mt-3">
          <h4>Insert New Service</h4>
          <form id="serviceFrm">
          <input type="text" id="addTitle" class="form-control mb-4" placeholder="Service Title"/>
          <input type="text" id="addShort_desc" class="form-control mb-4" placeholder="Service Short Description"/>
          <input type="text" id="addImg_path" class="form-control mb-4" placeholder="Service Image"/>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="addConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('style')

<script type="text/javascript">
  loadServicesData();

  function loadServicesData() {
      axios.get('/getServicesData')
          .then(function(response) {
              if (response.status == 200) {
                  $('#loadingDiv').addClass('d-none');
                  $('#dataDiv').removeClass('d-none');
                  var jsonData = response.data;
                  $('#ServiceDt').DataTable().destroy();
                  $('#servicesData').empty();
                  $.each(jsonData, function(i, item) {
                      $('<tr>').html(
                          "<th class='th-sm'><img class='table-img' src='" + jsonData[i].img_path + "'></th>" +
                          "<th class='th-sm'>" + jsonData[i].title + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].short_desc + "</th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='editbtn'><i class='fas fa-edit'></i></a></th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='deletebtn'><i class='fas fa-trash-alt'></i></a></th>"
                      ).appendTo('#servicesData');
                  });
                  $('.deletebtn').click(function() {
                      var id = $(this).attr('data-id');
                      $('#deleteConfirmBtn').attr('data-id', id);
                      $('#deleteModal').modal('show');
                  });

                  $('.editbtn').click(function() {
                      var id = $(this).attr('data-id');
                      $('#editConfirmBtn').attr('data-id', id);
                      EachEditData(id);
                      $('#editModal').modal('show');
                  });

                  $(document).ready(function() {
                      $('#ServiceDt').DataTable({"order":false});
                      $('.dataTables_length').addClass('bs-select');
                  });
              } else {
                  $('#loadingDiv').addClass('d-none');
                  $('#wrongDiv').removeClass('d-none');
              }
          }).catch(function(error) {
              $('#loadingDiv').addClass('d-none');
              $('#wrongDiv').removeClass('d-none');
          });
  }

  $('#deleteConfirmBtn').click(function() {
      var id = $(this).attr('data-id');
      deleteData(id);
      loadServicesData();
  });
  function deleteData(dataID) {
    $("#deleteConfirmBtn").html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
      axios.post('/deleteServicesData', {
              id: dataID
          })
          .then(function(response) {
            $('#deleteConfirmBtn').html("Delete");
              if (response.data == 1) {
                  $('#deleteModal').modal('hide');
                  toastr.success('Deleted Successfully');
              } else {
                $('#deleteModal').modal('hide');
                toastr.error('Data Deletion Failed');
              }
          }).catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Data Deletion Failed');
          });
  }


  function EachEditData(dataID) {
      axios.post('/getEachServiceData', {
              id: dataID
          })
          .then(function(response) {
              if (response.status == 200) {
                $('.editContent').removeClass('d-none');
                $('#loadingImg').addClass('d-none');
                var jsonData = response.data;
                $('#title').val(jsonData[0].title);
                $('#short_desc').val(jsonData[0].short_desc);
                $('#img_path').val(jsonData[0].img_path);
              } else {
                $('.loadingImg').addClass('d-none');
                $('.editErrorMsg').removeClass('d-none');
              }
          }).catch(function(error) {
            $('.loadingImg').addClass('d-none');
            $('.editErrorMsg').removeClass('d-none');
          });
  }

  $('#editConfirmBtn').click(function() {
    var id = $(this).attr('data-id');
    var title = $('#title').val();
    var short_desc = $('#short_desc').val();
    var img_path = $('#img_path').val();
      updateData(id,title,short_desc,img_path);
      loadServicesData();
  });
  function updateData(dataID,title,short_desc,img_path) {
          if(title.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (short_desc.length == 0) {
            toastr.error('Short Description can not be empty!');
          }
          else if (img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $("#editConfirmBtn").html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/updateServicesData', {
              id: dataID,
              title: title,
              short_desc: short_desc,
              img_path: img_path
                })
            .then(function(response) {
              $('#editConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Data Updated Successfully');
                } else {
                  $('#editModal').modal('hide');
                  toastr.error('Data Updation Failed');
                }
            })
            .catch(function(error) {
              $('#editModal').modal('hide');
              toastr.error('Data Updation Failed');
            });
          }
  }

  //Add New Services
  $('#addServicesBtn').click(function(){
    $('#addModal').modal('show');
  });
  $('#addConfirmBtn').click(function() {
    var title = $('#addTitle').val();
    var short_desc = $('#addShort_desc').val();
    var img_path = $('#addImg_path').val();
      addServiceData(title,short_desc,img_path);
      document.getElementById("serviceFrm").reset();
      loadServicesData();
  });
  function addServiceData(title,short_desc,img_path) {
          if(title.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (short_desc.length == 0) {
            toastr.error('Short Description can not be empty!');
          }
          else if (img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#addConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/addServicesData', {
              title: title,
              short_desc: short_desc,
              img_path: img_path
                })
            .then(function(response) {
              $('#addConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#addModal').modal('hide');
                    toastr.success('Data Inserted Successfully');
                } else {
                  $('#editModal').modal('hide');
                  toastr.error('Data Insertion Failed');
                }
            })
            .catch(function(error) {
              $('#editModal').modal('hide');
              toastr.error('Data Insertion Failed');
            });
          }
  }
</script>

@endsection

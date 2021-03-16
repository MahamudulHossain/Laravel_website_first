@extends('Layout.app')
@section('content')


<div class="container d-none" id="dataDivCourses">
<div class="row">
<div class="col-md-12 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addCourseBtn">Add New</button>
<table id="CourseDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Description</th>
    <th class="th-sm">Fee</th>
    <th class="th-sm">Enrolled</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='coursesData'>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container" id="loadingDivCourses">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img src="{{asset('images/4V0b.gif')}}" alt="">
</div>
</div>
</div>


<div class="container d-none" id="wrongDivCourses">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
</div>


<div class="modal fade" id="CoursesDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-5">
        <h5>Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button type="button" id="CoursesDeleteConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-4 mt-3">
        <div class="editCourseContent d-none">
          <input type="text" id="CourseTitle" class="form-control mb-4" />
          <input type="text" id="CourseDescription" class="form-control mb-4" />
          <input type="text" id="CourseFee" class="form-control mb-4" />
          <input type="text" id="CourseEnroll" class="form-control mb-4" />
          <input type="text" id="CourseClass" class="form-control mb-4" />
          <input type="text" id="CourseLink" class="form-control mb-4" />
          <input type="text" id="Img_path" class="form-control mb-4" />
        </div>
        <img src="{{asset('images/4V0b.gif')}}" class="loadingCourseImg" style="height: 120px;">
        <h5 class="editCourseErrorMsg d-none">Something Went Wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="editCourseConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="addCoursesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-2">
          <h4>Insert New Course</h4>
          <form id="courseFrm">
          <input type="text" id="addCourseTitle" class="form-control mb-4" placeholder="Course Title"/>
          <input type="text" id="addCourseDescription" class="form-control mb-4" placeholder="Course Description"/>
          <input type="text" id="addCourseFee" class="form-control mb-4" placeholder="Course Fee"/>
          <input type="text" id="addCourseEnroll" class="form-control mb-4" placeholder="Total Enrolled"/>
          <input type="text" id="addCourseClass" class="form-control mb-4" placeholder="Total Classes"/>
          <input type="text" id="addCourseLink" class="form-control mb-4" placeholder="Course Link"/>
          <input type="text" id="addImg_path" class="form-control mb-4" placeholder="Course Image"/>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="addCourseConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('style')

<script type="text/javascript">

  loadCoursesData();

  function loadCoursesData() {
      axios.get('/getCoursesData')
          .then(function(response) {
              if (response.status == 200) {
                  $('#loadingDivCourses').addClass('d-none');
                  $('#dataDivCourses').removeClass('d-none');
                  var jsonData = response.data;
                  $('#CourseDt').DataTable().destroy();
                  $('#coursesData').empty();
                  $.each(jsonData, function(i, item) {
                      $('<tr>').html(
                          "<th class='th-sm'>" + jsonData[i].course_name + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].course_des + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].course_fee + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].course_totalenroll + "</th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='CoursesEditbtn'><i class='fas fa-edit'></i></a></th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='CoursesDeletebtn'><i class='fas fa-trash-alt'></i></a></th>"
                      ).appendTo('#coursesData');
                    });
                    $('.CoursesDeletebtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#CoursesDeleteConfirmBtn').attr('data-id', id);
                        $('#CoursesDeleteModal').modal('show');
                    });
                    $('.CoursesEditbtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#editCourseConfirmBtn').attr('data-id', id);
                        EachEditCourseData(id);
                        $('#editCourseModal').modal('show');
                    });
                    $(document).ready(function() {
                        $('#CourseDt').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    });
                  } else {
                      $('#loadingDivCourses').addClass('d-none');
                      $('#wrongDivCourses').removeClass('d-none');
                  }
              }).catch(function(error) {
                  $('#loadingDivCourses').addClass('d-none');
                  $('#wrongDivCourses').removeClass('d-none');
              });
  }

  $('#CoursesDeleteConfirmBtn').click(function() {
      var id = $(this).attr('data-id');
      deleteCoursesData(id);
      loadCoursesData();
  });
  function deleteCoursesData(dataID) {
    $(this).html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
      axios.post('/deleteCoursesData', {
              id: dataID
          })
          .then(function(response) {
            $('#CoursesDeleteConfirmBtn').html("Delete");
              if (response.data == 1) {
                  $('#CoursesDeleteModal').modal('hide');
                  toastr.success('Deleted Successfully');
              } else {
                $('#CoursesDeleteModal').modal('hide');
                toastr.error('Data Deletion Failed');
              }
          }).catch(function(error) {
            $('#CoursesDeleteModal').modal('hide');
            toastr.error('Data Deletion Failed');
          });
  }

  //Edit Courses

  function EachEditCourseData(dataID) {
      axios.post('/getEachCourseData', {
              id: dataID
          })
          .then(function(response) {
              if (response.status == 200) {
                $('.editCourseContent').removeClass('d-none');
                $('.loadingCourseImg').addClass('d-none');
                var jsonData = response.data;
                $('#CourseTitle').val(jsonData[0].course_name);
                $('#CourseDescription').val(jsonData[0].course_des);
                $('#CourseFee').val(jsonData[0].course_fee);
                $('#CourseEnroll').val(jsonData[0].course_totalenroll);
                $('#CourseClass').val(jsonData[0].course_totalclass);
                $('#CourseLink').val(jsonData[0].course_link);
                $('#Img_path').val(jsonData[0].course_img);
              } else {
                $('.loadingCourseImg').addClass('d-none');
                $('.editCourseErrorMsg').removeClass('d-none');
              }
          }).catch(function(error) {
            $('.loadingCourseImg').addClass('d-none');
            $('.editCourseErrorMsg').removeClass('d-none');
          });
  }

  $('#editCourseConfirmBtn').click(function() {
    var id = $(this).attr('data-id');
    var CourseTitle = $('#CourseTitle').val();
    var CourseDescription = $('#CourseDescription').val();
    var CourseFee = $('#CourseFee').val();
    var CourseEnroll = $('#CourseEnroll').val();
    var CourseClass = $('#CourseClass').val();
    var CourseLink = $('#CourseLink').val();
    var Img_path = $('#Img_path').val();
      updateCourseData(id,CourseTitle,CourseDescription,CourseFee,CourseEnroll,CourseClass,CourseLink,Img_path);
      loadCoursesData();
  });
  function updateCourseData(dataID,CourseTitle,CourseDescription,CourseFee,CourseEnroll,CourseClass,CourseLink,Img_path) {
          if(CourseTitle.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (CourseDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (CourseFee.length == 0) {
            toastr.error('Course Fee can not be empty!');
          }
          else if (CourseEnroll.length == 0) {
            toastr.error('Total Enrolled can not be empty!');
          }
          else if (CourseClass.length == 0) {
            toastr.error('Total Classes can not be empty!');
          }
          else if (CourseLink.length == 0) {
            toastr.error('Course Link can not be empty!');
          }
          else if (Img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#editCourseConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/updateCourseData', {
              id: dataID,
              CourseTitle: CourseTitle,
              CourseDescription: CourseDescription,
              CourseFee: CourseFee,
              CourseEnroll: CourseEnroll,
              CourseClass: CourseClass,
              CourseLink: CourseLink,
              Img_path: Img_path
                })
            .then(function(response) {
              $('#editCourseConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#editCourseModal').modal('hide');
                    toastr.success('Data Updated Successfully');
                } else {
                  $('#editCourseModal').modal('hide');
                  toastr.error('Data Updation Failed');
                }
            })
            .catch(function(error) {
              $('#editCourseModal').modal('hide');
              toastr.error('Data Updation Failed');
            });
          }
  }

  //Add New Course
  $('#addCourseBtn').click(function(){
    $('#addCoursesModal').modal('show');
  });
  $('#addCourseConfirmBtn').click(function() {
    var addCourseTitle = $('#addCourseTitle').val();
    var addCourseDescription = $('#addCourseDescription').val();
    var addCourseFee = $('#addCourseFee').val();
    var addCourseEnroll = $('#addCourseEnroll').val();
    var addCourseClass = $('#addCourseClass').val();
    var addCourseLink = $('#addCourseLink').val();
    var addImg_path = $('#addImg_path').val();
      addCourseData(addCourseTitle,addCourseDescription,addCourseFee,addCourseEnroll,addCourseClass,addCourseLink,addImg_path);
      document.getElementById("courseFrm").reset();
      loadCoursesData();

  });
  function addCourseData(addCourseTitle,addCourseDescription,addCourseFee,addCourseEnroll,addCourseClass,addCourseLink,addImg_path) {
          if(addCourseTitle.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (addCourseDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (addCourseFee.length == 0) {
            toastr.error('Course Fee can not be empty!');
          }
          else if (addCourseEnroll.length == 0) {
            toastr.error('Total Enrolled can not be empty!');
          }
          else if (addCourseClass.length == 0) {
            toastr.error('Total Classes can not be empty!');
          }
          else if (addCourseLink.length == 0) {
            toastr.error('Course Link can not be empty!');
          }
          else if (addImg_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#addCourseConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/addCoursesData', {
              addCourseTitle: addCourseTitle,
              addCourseDescription: addCourseDescription,
              addCourseFee: addCourseFee,
              addCourseEnroll: addCourseEnroll,
              addCourseClass: addCourseClass,
              addCourseLink: addCourseLink,
              addImg_path: addImg_path
                })
            .then(function(response) {
              $('#addCourseConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#addCoursesModal').modal('hide');
                    toastr.success('Data Inserted Successfully');
                } else {
                  $('#addCoursesModal').modal('hide');
                  toastr.error('Data Insertion Failed');
                }
            })
            .catch(function(error) {
              $('#addCoursesModals').modal('hide');
              toastr.error('Data Insertion Failed');
            });
          }
  }

</script>

@endsection

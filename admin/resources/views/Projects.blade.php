@extends('Layout.app')
@section('content')

<div class="container d-none" id="dataDivProjects">
<div class="row">
<div class="col-md-12 p-5">
  <button class="btn btn-sm btn-danger mb-3" id="addProjectBtn">Add New</button>
<table id="ProjectDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Description</th>
    <th class="th-sm">Image</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='projectsData'>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container" id="loadingDivProjects">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img src="{{asset('images/4V0b.gif')}}" alt="">
</div>
</div>
</div>


<div class="container d-none" id="wrongDivProjects">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
</div>


<div class="modal fade" id="ProjectsDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-5">
        <h5>Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button type="button" id="ProjectsDeleteConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-4 mt-3">
        <div class="editProjectContent d-none">
          <input type="text" id="ProjectTitle" class="form-control mb-4" />
          <input type="text" id="ProjectDescription" class="form-control mb-4" />
          <input type="text" id="ProjectLink" class="form-control mb-4" />
          <input type="text" id="Project_Img_path" class="form-control mb-4" />
        </div>
        <img src="{{asset('images/4V0b.gif')}}" class="loadingProjectImg" style="height: 120px;">
        <h5 class="editProjectErrorMsg d-none">Something Went Wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="editProjectConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addProjectsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-2">
          <h4>Insert New Project</h4>
          <form id="projectFrm">
          <input type="text" id="addProjectTitle" class="form-control mb-4" placeholder="Project Title"/>
          <input type="text" id="addProjectDescription" class="form-control mb-4" placeholder="Project Description"/>
          <input type="text" id="addProjectLink" class="form-control mb-4" placeholder="Project Link"/>
          <input type="text" id="add_Project_Img_path" class="form-control mb-4" placeholder="Project Image"/>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="addProjectConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('style')

<script type="text/javascript">

  loadProjectsData();

  function loadProjectsData() {
      axios.get('/getProjectsData')
          .then(function(response) {
              if (response.status == 200) {
                  $('#loadingDivProjects').addClass('d-none');
                  $('#dataDivProjects').removeClass('d-none');
                  var jsonData = response.data;
                  $('#ProjectDt').DataTable().destroy();
                  $('#projectsData').empty();
                  $.each(jsonData, function(i, item) {
                      $('<tr>').html(
                          "<th class='th-sm'>" + jsonData[i].project_name + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].project_des + "</th>" +
                          "<th class='th-sm'>" + jsonData[i].project_img + "</th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='ProjectsEditbtn'><i class='fas fa-edit'></i></a></th>" +
                          "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='ProjectsDeletebtn'><i class='fas fa-trash-alt'></i></a></th>"
                      ).appendTo('#projectsData');
                    });
                    $('.ProjectsDeletebtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#ProjectsDeleteConfirmBtn').attr('data-id', id);
                        $('#ProjectsDeleteModal').modal('show');
                    });
                    $('.ProjectsEditbtn').click(function() {
                        var id = $(this).attr('data-id');
                        $('#editProjectConfirmBtn').attr('data-id', id);
                        EachEditProjectData(id);
                        $('#editProjectModal').modal('show');
                    });
                    $(document).ready(function() {
                        $('#ProjectDt').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    });
                  } else {
                      $('#loadingDivProjects').addClass('d-none');
                      $('#wrongDivProjects').removeClass('d-none');
                  }
              }).catch(function(error) {
                  $('#loadingDivProjects').addClass('d-none');
                  $('#wrongDivProjects').removeClass('d-none');
              });
  }

  $('#ProjectsDeleteConfirmBtn').click(function() {
      var id = $(this).attr('data-id');
      deleteProjectsData(id);
      loadProjectsData();
  });
  function deleteProjectsData(dataID) {
    $('#ProjectsDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
      axios.post('/deleteProjectsData', {
              id: dataID
          })
          .then(function(response) {
            $('#ProjectsDeleteConfirmBtn').html("Delete");
              if (response.data == 1) {
                  $('#ProjectsDeleteModal').modal('hide');
                  toastr.success('Deleted Successfully');
              } else {
                $('#ProjectsDeleteModal').modal('hide');
                toastr.error('Data Deletion Failed');
              }
          }).catch(function(error) {
            $('#ProjectsDeleteModal').modal('hide');
            toastr.error('Data Deletion Failed');
          });
  }

  //Edit Projects

  function EachEditProjectData(dataID) {
      axios.post('/getEachProjectData', {
              id: dataID
          })
          .then(function(response) {
              if (response.status == 200) {
                $('.editProjectContent').removeClass('d-none');
                $('.loadingProjectImg').addClass('d-none');
                var jsonData = response.data;
                $('#ProjectTitle').val(jsonData[0].project_name);
                $('#ProjectDescription').val(jsonData[0].project_des);
                $('#ProjectLink').val(jsonData[0].project_link);
                $('#Project_Img_path').val(jsonData[0].project_img);
              } else {
                $('.loadingProjectImg').addClass('d-none');
                $('.editProjectErrorMsg').removeClass('d-none');
              }
          }).catch(function(error) {
            $('.loadingProjectImg').addClass('d-none');
            $('.editProjectErrorMsg').removeClass('d-none');
          });
  }

  $('#editProjectConfirmBtn').click(function() {
    var id = $(this).attr('data-id');
    var ProjectTitle = $('#ProjectTitle').val();
    var ProjectDescription = $('#ProjectDescription').val();
    var ProjectLink = $('#ProjectLink').val();
    var Project_Img_path = $('#Project_Img_path').val();
      updateProjectData(id,ProjectTitle,ProjectDescription,ProjectLink,Project_Img_path);
      loadProjectsData();
  });
  function updateProjectData(dataID,ProjectTitle,ProjectDescription,ProjectLink,Project_Img_path) {
          if(ProjectTitle.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (ProjectDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (ProjectLink.length == 0) {
            toastr.error('Project Link can not be empty!');
          }
          else if (Project_Img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#editProjectConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/updateProjectData', {
              id: dataID,
              ProjectTitle: ProjectTitle,
              ProjectDescription: ProjectDescription,
              ProjectLink: ProjectLink,
              Project_Img_path: Project_Img_path
                })
            .then(function(response) {
              $('#editProjectConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#editProjectModal').modal('hide');
                    toastr.success('Data Updated Successfully');
                } else {
                  $('#editProjectModal').modal('hide');
                  toastr.error('Data Updation Failed');
                }
            })
            .catch(function(error) {
              $('#editProjectModal').modal('hide');
              toastr.error('Data Updation Failed');
            });
          }
  }

  //Add New Project
  $('#addProjectBtn').click(function(){
    $('#addProjectsModal').modal('show');
  });
  $('#addProjectConfirmBtn').click(function() {
    var addProjectTitle = $('#addProjectTitle').val();
    var addProjectDescription = $('#addProjectDescription').val();
    var addProjectLink = $('#addProjectLink').val();
    var add_Project_Img_path = $('#add_Project_Img_path').val();
      addProjectData(addProjectTitle,addProjectDescription,addProjectLink,add_Project_Img_path);
      document.getElementById("projectFrm").reset();
      loadProjectsData();

  });
  function addProjectData(addProjectTitle,addProjectDescription,addProjectLink,add_Project_Img_path) {
          if(addProjectTitle.length == 0){
            toastr.error('Title can not be empty!');
          }
          else if (addProjectDescription.length == 0) {
            toastr.error('Description can not be empty!');
          }
          else if (addProjectLink.length == 0) {
            toastr.error('Project Link can not be empty!');
          }
          else if (add_Project_Img_path.length == 0) {
            toastr.error('Img Path can not be empty!');
          }
          else{
            $('#addProjectConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
            axios.post('/addProjectsData', {
              addProjectTitle: addProjectTitle,
              addProjectDescription: addProjectDescription,
              addProjectLink: addProjectLink,
              add_Project_Img_path: add_Project_Img_path
                })
            .then(function(response) {
              $('#addProjectConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#addProjectsModal').modal('hide');
                    toastr.success('Data Inserted Successfully');
                } else {
                  $('#addProjectsModal').modal('hide');
                  toastr.error('Data Insertion Failed');
                }
            })
            .catch(function(error) {
              $('#addProjectsModals').modal('hide');
              toastr.error('Data Insertion Failed');
            });
          }
  }

</script>

@endsection

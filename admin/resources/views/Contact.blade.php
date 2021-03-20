@extends('Layout.app')
@section('content')
@section('title','Admin Panel- Contact')
<div class="container d-none" id="dataDivContacts">
<div class="row">
<div class="col-md-12 p-5">
<table id="ContactDt" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Mobile</th>
    <th class="th-sm">Email</th>
	  <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id='contactsData'>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container" id="loadingDivContacts">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img src="{{asset('images/4V0b.gif')}}" alt="">
</div>
</div>
</div>

<div class="container d-none" id="wrongDivContacts">
<div class="row">
<div class="col-md-12 p-3 m-5 text-center">
  <h4>Something Went Wrong!</h4>
</div>
</div>
</div>

<div class="modal fade" id="ContactsDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3 mt-5">
        <h5>Do you want to delete?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button type="button" id="ContactsDeleteConfirmBtn" data-id=" " class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('style')

<script type="text/javascript">

loadContactsData();

function loadContactsData() {
    axios.get('/getContactsData')
        .then(function(response) {
            if (response.status == 200) {
                $('#loadingDivContacts').addClass('d-none');
                $('#dataDivContacts').removeClass('d-none');
                var jsonData = response.data;
                $('#ContactDt').DataTable().destroy();
                $('#contactsData').empty();
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<th class='th-sm'>" + jsonData[i].contact_name + "</th>" +
                        "<th class='th-sm'>" + jsonData[i].contact_mobile + "</th>" +
                        "<th class='th-sm'>" + jsonData[i].contact_email + "</th>" +
                        "<th class='th-sm'>" + jsonData[i].contact_msg + "</th>" +
                        "<th class='th-sm'><a data-id=" + jsonData[i].id + " class='ContactsDeletebtn'><i class='fas fa-trash-alt'></i></a></th>"
                    ).appendTo('#contactsData');
                  });
                  $('.ContactsDeletebtn').click(function() {
                      var id = $(this).attr('data-id');
                      $('#ContactsDeleteConfirmBtn').attr('data-id', id);
                      $('#ContactsDeleteModal').modal('show');
                  });
                  $('.ContactsEditbtn').click(function() {
                      var id = $(this).attr('data-id');
                      $('#editContactConfirmBtn').attr('data-id', id);
                      EachEditContactData(id);
                      $('#editContactModal').modal('show');
                  });
                  $(document).ready(function() {
                      $('#ContactDt').DataTable({"order":false});
                      $('.dataTables_length').addClass('bs-select');
                  });
                } else {
                    $('#loadingDivContactts').addClass('d-none');
                    $('#wrongDivContacts').removeClass('d-none');
                }
            }).catch(function(error) {
                $('#loadingDivContacts').addClass('d-none');
                $('#wrongDivContacts').removeClass('d-none');
            });
}

$('#ContactsDeleteConfirmBtn').click(function() {
    var id = $(this).attr('data-id');
    deleteContactsData(id);
    loadContactsData();
});
function deleteContactsData(dataID) {
  $('#ContactsDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
    axios.post('/deleteContactsData', {
            id: dataID
        })
        .then(function(response) {
          $('#ContactsDeleteConfirmBtn').html("Delete");
            if (response.data == 1) {
                $('#ContactsDeleteModal').modal('hide');
                toastr.success('Deleted Successfully');
            } else {
              $('#ContactsDeleteModal').modal('hide');
              toastr.error('Data Deletion Failed');
            }
        }).catch(function(error) {
          $('#ContactsDeleteModal').modal('hide');
          toastr.error('Data Deletion Failed');
        });
}

</script>

@endsection

$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


function loadServicesData() {
    axios.get('/getServicesData')
        .then(function(response) {
            if (response.status == 200) {
                $('#loadingDiv').addClass('d-none');
                $('#dataDiv').removeClass('d-none');
                var jsonData = response.data;
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
                $('#deleteConfirmBtn').click(function() {
                    var id = $(this).attr('data-id');
                    deleteData(id);
                    loadServicesData();
                });
                $('.editbtn').click(function() {
                    var id = $(this).attr('data-id');
                    $('#editConfirmBtn').attr('data-id', id);
                    EachEditData(id);
                    $('#editModal').modal('show');
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


function deleteData(dataID) {
    axios.post('/deleteServicesData', {
            id: dataID
        })
        .then(function(response) {
            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Deleted Successfully');
            } else {

            }
        }).catch(function(error) {

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

$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


function loadServicesData(){
  axios.get('/getServicesData')
    .then(function(response){
      var jsonData = response.data;
      $.each(jsonData,function(i,item){
        $('<tr>').html(
          "<th class='th-sm'><img class='table-img' src='"+jsonData[i].img_path+"'></th>"+
          "<th class='th-sm'>"+jsonData[i].title+"</th>"+
          "<th class='th-sm'>"+jsonData[i].short_desc+"</th>"+
          "<th class='th-sm'><a href=''><i class='fas fa-edit'></i></a></th>"+
          "<th class='th-sm'><a href=''><i class='fas fa-trash-alt'></i></a></th>"
        ).appendTo('#servicesData');
      });
    }).catch(function (error) {

  });
}

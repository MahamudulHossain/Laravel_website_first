@extends('Layout.app')
@section('content')

<div class="container d-none" id="dataDiv">
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


@endsection

@section('style')
<script type="text/javascript">
  loadServicesData();
</script>


@endsection

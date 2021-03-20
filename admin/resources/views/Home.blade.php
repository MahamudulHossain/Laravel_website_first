@extends('Layout.app')
@section('title','Admin Panel- Home')
@section('content')

<div class="row">
<div class="col-md-6 col-lg-3 grid-margin stretch-card">
	  <div class="card mt-2">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Total Visited &nbsp;</h4>
			</div>
      <div>
			  <h4 class="font-weight-normal">{{$vsCount}}</h4>
			</div>
		  </div>
		</div>
	  </div>
</div>

<div class="col-md-6 col-lg-3 grid-margin stretch-card">
	  <div class="card mt-2">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Total Courses &nbsp;</h4>
			</div>
      <div>
			  <h4 class="font-weight-normal">{{$crsCount}}</h4>
			</div>
		  </div>
		</div>
	  </div>
</div>

<div class="col-md-6 col-lg-3 grid-margin stretch-card">
	  <div class="card mt-2">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Total Projects &nbsp;</h4>
			</div>
      <div>
        <h4 class="font-weight-normal">{{$proCount}}</h4>
      </div>
		  </div>
		</div>
	  </div>
</div>

<div class="col-md-6 col-lg-3 grid-margin stretch-card">
	  <div class="card mt-2">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Total Services &nbsp;</h4>
			</div>
      <div>
			  <h4 class="font-weight-normal">{{$serCount}}</h4>
			</div>
		  </div>
		</div>
	  </div>
</div>

<div class="col-md-6 col-lg-3 grid-margin stretch-card">
	  <div class="card mt-2">
		<div class="card-body">
		  <h1 class="font-weight-light mb-4">
		  </h1>
		  <div class="d-flex flex-wrap align-items-center">
			<div>
			  <h4 class="font-weight-normal">Total Contacts &nbsp;</h4>
			</div>
      <div>
			  <h4 class="font-weight-normal">{{$conCount}}</h4>
			</div>
		  </div>
		</div>
	  </div>
</div>
</div>

@endsection

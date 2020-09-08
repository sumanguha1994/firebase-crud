@extends('layout_master.layout')
@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">Firebase Dashboard > Table Create </h3>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">
				<a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
					<span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
					<span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">{{ date('F jS') }}</span>

					<!--<i class="flaticon2-calendar-1"></i>-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24" />
							<path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
						</g>
					</svg>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
		<div class="col-xl-8 col-lg-12 order-lg-1 order-xl-1">
			<div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
				<div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Tables Contants
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fit">
                    <form action="{{url('create-table-form')}}" method="post">
                        {{csrf_field()}}
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Table Info:</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Table Name</label>
                                    <input type="text" name="tablename" id="tablename" placeholder="Enter Table Name" required class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <label for="" id="lab0"></label>
                                    <input type="text" id="input0" onkeyup="eneterlabel('0', this.value)" class="form-control" placeholder="Enter Table Columns Name">
                                </div>
                                <div class="col-md-4">
                                    <label for=""></label>
                                    <button type="button" class="btn btn-primary" onclick="addfields()" style="margin-top: 25px"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <span id="adddiv"></span>
                            <br />
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-9 text-left">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- end:: Content -->
<script>
    var i = 1;
    function addfields()
    {
        let divhtml;
        divhtml = '<div class="row" id="rowid'+i+'"><div class="col-md-2"></div><div class="col-md-4"><label id="lab'+i+'"></label>';
        divhtml += '<input type="" id="input'+i+'" onkeyup="eneterlabel('+i+', this.value)" class="form-control" placeholder="Enter Table Columns Name">';
        divhtml += '</div><div class="col-md-4"><label for=""></label>';
        divhtml += '<button type="button" class="btn btn-warning" onclick="removefield('+i+')" style="margin-top: 25px"><i class="fa fa-minus"></i></button>';
        divhtml += '</div></div>';
        $('#adddiv').append(divhtml);
        i++;
    }

    function removefield(id)
    {
        $('#rowid'+id).remove();
    }

    function eneterlabel(id, inputvalue)
    {
        if(inputvalue.search(' ') != -1){
            Swal.fire("Can't use a space in field name !!");
            $('#input'+id).focus();
            $('#input'+id).val('');
            $('#lab'+id).html('');
            return false;
        }else{
            $('#lab'+id).html(inputvalue);
            $('#input'+id).attr('name', inputvalue);
        }
    }
</script>
@endsection
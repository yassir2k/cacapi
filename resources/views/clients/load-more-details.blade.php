@extends('layouts.plain')
@section('content')
<br />
<br />
<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
		<legend class="scheduler-border" >Feedback From {{ $_feedback->name_ }}</legend>
        <br />

        <div class="row"><!-- Main Data -->
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2 ">
				Respondent:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->name_ }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				Profession:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->profession_ }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				Accreditation:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->accreditation_ }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				Date:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->date_ }}</strong>
			</div>
		</div>
        

        <br />
        <div class="row"><!-- Service Delivery -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2">
                <h4 style="border-bottom: 2px solid #8FBC8F">Service Delivery</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2" align="left">
            Are you satisfied with the conduct of the Name Availability for your registration?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->service_delivery1 }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            Which Registration service have you done online?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->service_delivery2 }}</strong>
			</div>
		</div>

        <br />
        <div class="row"><!-- Quality -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2">
                <h4 style="border-bottom: 2px solid #8FBC8F">Quality</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            How satisfied are you with the services we provide?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->quality_ }}</strong>
			</div>
		</div>

        <br />
        <div class="row"><!-- Timeliness -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2">
                <h4 style="border-bottom: 2px solid #8FBC8F">Timeliness</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            How fast did we deliver the services you asked for?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->timeliness1 }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2"  align="left">
            Did you have cause to complain on anything? Which was your preferred channel of communicating the complaints?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->timeliness2 }}</strong>@if(!(is_null($_feedback->others)))
					<strong>&nbsp; ({{ $_feedback->others }})</strong>
				@endif
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            Were you satisfied with the way the complaint was handled?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->timeliness3 }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            How helpful did you find our Staff?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->timeliness4 }}</strong>
			</div>
		</div>

        <br />
        <div class="row"><!-- Online Environment -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2">
                <h4 style="border-bottom: 2px solid #8FBC8F">Online Environment</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2" align="left">
            How satisfied are you with the effectiveness of the process flow of the online registration system?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->online_environment1 }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            How would you rate the e-stamping interface on the CRP?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->online_environment2 }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            How satisfied are you with the Remita payment platform on the CRP?
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->online_environment3 }}</strong>
			</div>
		</div>

        <br />
        <div class="row"><!-- Challenges -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2" align="left">
                <h4 style="border-bottom: 2px solid #8FBC8F">Challenges</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            What are the most common challenges you usually encounter?
			</div>
			<div class="col-sm-5 d-flex p-2" align="justify">
				<strong>{{ $_feedback->challenges_ }}</strong>
			</div>
            <div class="col-sm-1 ">
			</div>
		</div>


        <br />
        <div class="row"><!-- Challenges -->
            <div class="col-sm-1">
			</div>
            <div class="col-sm-6 d-flex p-2" align="left">
                <h4 style="border-bottom: 2px solid #8FBC8F">Changes</h4>
            </div>
            <div class="col-sm-5">
			</div>
        </div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            What changes would you like us to make in our services to you?
			</div>
			<div class="col-sm-5 d-flex p-2" align="justify">
				<strong>{{ $_feedback->changes_ }}</strong>
			</div>
            <div class="col-sm-1 ">
			</div>
		</div>
</fieldset>
<br />
@endsection
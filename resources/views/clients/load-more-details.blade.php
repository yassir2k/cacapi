@extends('layouts.plain')
@section('content')
<br />
<br />
<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
		<legend class="scheduler-border" >Log Details for Transaction ID: {{ $_feedback->transaction_id }}</legend>
        <br />
        <br />
        <div class="row"><!-- Main Data -->
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2 ">
				API Call Description:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->details }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				API Call Datetime:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->api_call_datetime }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				Requesting IP Address:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->ip_address }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
				Requesting Device Type:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->device }}</strong>
			</div>
		</div>

        <br />

        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2" align="left">
            Browser used for Request:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->browser }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            Requesting Device Operating System:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->operating_system }}</strong>
			</div>
		</div>

        <br />

        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            API Call Type:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{$_feedback->call_type}}</strong>
			</div>
		</div>

        <br />

        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2"  align="left">
            API Call Cost:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ number_format($_feedback->api_call_cost, 2) }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            Response Code:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->response_code }}</strong>
			</div>
		</div>
        <br />
        <div class="row">
			<div class="col-sm-1 ">
			</div>
			<div class="col-sm-5 d-flex p-2">
            Username:
			</div>
			<div class="col-sm-6 d-flex p-2">
				<strong>{{ $_feedback->username }}</strong>
			</div>
		</div>
</fieldset>
<br />
@endsection
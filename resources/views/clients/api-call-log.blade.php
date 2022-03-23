@extends('layouts.template')
@section('title', 'API Calls Log')
@section('content')
@if(session()->has('message'))
    <div id="s_alert" class="alert alert-success alert-dismissible" style="position:absolute; height:auto; right:50px; top:50px; z-index:999">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ session()->get('message')}}
    </div>
@endif

<div id="app">
    <API></API>
</div>


<script src="{{ mix('js/app.js') }}"></script>
@endsection
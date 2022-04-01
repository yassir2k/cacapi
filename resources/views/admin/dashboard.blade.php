@extends('layouts.template')
@section('title', 'Admin Dashboard')
@section('content')

<div id="app">
    <Admin-Dashboard></Admin-Dashboard>
</div>


<script src="{{ mix('js/app.js') }}"></script>
@endsection
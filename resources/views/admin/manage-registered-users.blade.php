@extends('layouts.template')
@section('title', 'Manage Registered Users')
@section('content')

<div id="app">
    <ManageRegisteredUsers></ManageRegisteredUsers>
</div>


<script src="{{ mix('js/app.js') }}"></script>
@endsection
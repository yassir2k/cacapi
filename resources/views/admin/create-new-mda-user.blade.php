@extends('layouts.template')
@section('title', 'Create New MDA User')
@section('content')

<div id="app">
    <CreateMdaUser></CreateMdaUser>
</div>


<script src="{{ mix('js/app.js') }}"></script>
@endsection
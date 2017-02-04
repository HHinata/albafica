@extends('layouts.layout')

@section('content')
<!-- Page Loader -->
<loader></loader>
<!-- #END# Page Loader -->
<!-- Search Bar -->
<searchbar></searchbar>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<navbar></navbar>
<!-- #Top Bar -->
<sidebar></sidebar>
<section class="content">
    <router-view></router-view>
</section>
@endsection
@extends('admin.master')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Welcome to Admin Dashboard
            </div>
            <div class="panel-body">
                <p>You are logged in as admin</p>
            </div>
        </div>
    </div>
</div>
@endsection
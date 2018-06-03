<!DOCTYPE html>
<html>
<head>
	@extends('partials.index.top')
</head>
<body>

	@include('partials.index.nav')
		
	<div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Personal Appliance App</h1>
          <p>Manage your own accounts</p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
        </div>
    </div>


	@include('partials.statistics.data')

	@include('partials.index.bottom')
</body>
</html>



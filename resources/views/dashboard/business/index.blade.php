@extends('dashboard.business.layout')

@section('form')

    <h3>Business Data</h3>
    <p>Change your business settings from here</p>
    <br>
    <p><b>Name</b>: {{ $business->name }}</p>
    <p><b>Admin</b>: {{ $business->admin->name }}</p>
    <p><b>Address</b>: {{ $business->address }}</p>
    <p><b>Location</b>: {{ $business->city->location }}</p>
    <p><b>Website</b>: {{ $business->url }}</p>

@endsection

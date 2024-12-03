<!-- resources/views/user/profile.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>My Profile</h1>
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection

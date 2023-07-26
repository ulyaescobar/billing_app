<!-- resources/views/profile/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Profile</div>

                    <div class="card-body">
                        <h3>Welcome, {{ Auth::user()->name }}</h3>
                        <p>Email: {{ Auth::user()->email }}</p>

                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="bio">Bio:</label>
                                <textarea class="form-control" id="bio" name="bio">{{ $profile->bio ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $profile->address ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar:</label>
                                <input type="file" class="form-control-file" id="avatar" name="avatar">
                                @if ($profile->avatar)
                                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar"
                                        style="max-width: 100px; max-height: 100px;">
                                @endif
                            </div>
                            <!-- Add more profile fields as needed -->

                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

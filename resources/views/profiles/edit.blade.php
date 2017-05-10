@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your profile</div>

                    <div class="panel-body">
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="avatar">Upload avatar</label>
                                <input type="file" name="avatar" accept="image/*"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input required type="text" name="location" value="{{ $info->location }}"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="location">About me</label>
                                <textarea required name="about" id="about" cols="30" rows="10"
                                          class="form-control">{{ $info->about }}</textarea>
                            </div>

                            <div class="form-group">
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                                </p>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

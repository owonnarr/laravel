@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{ url( '/dashboard/abouts') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputCatName">Abouts</label>
                    <input type="text" name="name" class="form-control" id="inputCatName" placeholder="about" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('name') }}
                    </strong>
                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputAboutPreview">Preview</label>
                    <input type="file" class="form-control" id="inputAboutPreview" placeholder="Preview" name="preview">
                    @if ($errors->has('preview'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('preview') }}
                    </strong>
                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputAboutDescription">Description</label>
                    <textarea name="description" id="inputAboutDescription" cols="30" rows="10" class="form-control">{{ old('description') }}
                </textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('description') }}
                    </strong>
                </span>
                    @endif
                </div>

                {{ csrf_field() }}

                <button type="submit" class="btn btn-info">CREATE</button>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>

@endsection
@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{ route('abouts.update', $about->id) }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputCatName">Name</label>
                    <input type="text" name="name" class="form-control" id="inputCatName" placeholder="Name Abouts" value="{{ $about->name }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('name') }}
                    </strong>
                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputCatPreview">Preview</label>
                    <input type="file" class="form-control" id="inputCatPreview" placeholder="Preview" name="preview">
                    @if ($errors->has('preview'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('preview') }}
                    </strong>
                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputCatDescription">Description</label>
                    <textarea name="description" id="inputCatDescription" cols="30" rows="10" class="form-control">{{ $about->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('description') }}
                    </strong>
                </span>
                    @endif
                </div>

                {{ csrf_field() }}

                <input type="hidden" name="_method" value="patch">

                <button type="submit" class="btn btn-info">UPDATE</button>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>

@endsection
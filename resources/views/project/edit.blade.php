@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form method="post" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ $project->name }}">
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('name') }}
                    </strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputCategory">Category</label>
                <select class="form-control" id="inputCategory" name="category_id">
                    @foreach($categories as $category)
                        @if($category->id == $project->category_id)
                        <option selected="selected" value="{{ $category->id }}">{{ $category->category }}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->category }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputPreview">Preview</label>
                <input type="file" class="form-control" id="inputPreview" placeholder="Preview" name="preview">
                @if ($errors->has('preview'))
                <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('preview') }}
                    </strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputClient">Client</label>
                <input type="text" class="form-control" id="inputClient" placeholder="Client" name="client" value="{{ $project->client }}">
                @if ($errors->has('client'))
                <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('client') }}
                    </strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea name="description" id="inputDescription" cols="30" rows="10" class="form-control">{{ $project->description }}</textarea>
                @if ($errors->has('description'))
                <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('description') }}
                    </strong>
                </span>
                @endif
            </div>
            @if($project->published == 0)
            <div class="form-group" data-toggle="buttons">
                <label class="btn btn-success">
                    <input type="checkbox" name="published" value="1" id="option2"> ACTIVATE
                </label>
                @if ($errors->has('published'))
                    <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('published') }}
                    </strong>
                    </span>
                 @endif
            </div>
            @else
                <div class="form-group" data-toggle="buttons">
                    <label class="btn btn-danger">
                        <input type="checkbox" name="published" value="0" id="option2"> DEACTIVATE
                    </label>
                    @if ($errors->has('published'))
                        <span class="help-block">
                    <strong class="text-danger">
                    {{ $errors->first('published') }}
                    </strong>
                    </span>
                    @endif
                </div>
            @endif
            {{ csrf_field() }}
            
            <input type="hidden" name="_method" value="patch">
            
            <button type="submit" class="btn btn-info">UPDATE</button>
        </form>
    </div>
    <div class="col-md-6"></div>
</div>

@endsection
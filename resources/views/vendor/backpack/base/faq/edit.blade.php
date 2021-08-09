@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        FAQ
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">FAQ</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update FAQ
                </div>

                <div class="box-body">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/faq/update') }}">
                          {!! csrf_field() !!}
                          <div class="form-group @if($errors->has('question')) has-error  @endif">
                            <label for="exampleInputEmail1">Question</label>
                            <textarea name="question" class="form-control my-editor">{{ $data ? $data->question : '' }}</textarea>
                            @if($errors->has('question')) <span class="help-block">{{ $errors->first('question') }}</span>  @endif
                          </div>
                          <div class="form-group @if($errors->has('answer')) has-error  @endif">
                            <label for="exampleInputEmail1">Answer</label>
                            <textarea name="answer" class="form-control my-editor">{{ $data ? $data->answer : '' }}</textarea>
                            @if($errors->has('answer')) <span class="help-block">{{ $errors->first('answer') }}</span>  @endif
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category_id" required="required" class="form-control">
                              <option value="">Select Category</option>
                              @foreach($category as $list)
                                <option value="{{ $list->id }}" @if($data->faq_category_id == $list->id) selected @endif>{{ $list->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <input type="hidden" name="id" value="{{ $data->id }}">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

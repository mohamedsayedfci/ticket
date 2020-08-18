@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <section class="content">

                        <div class="box box-primary">

                            <div class="box-header">
                                <h3 class="box-title">@lang('site.add')</h3>
                            </div><!-- end of box header -->

                            <div class="box-body">

                                @include('partials._errors')

                                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                    {{ method_field('post') }}

                                    <div class="form-group">
                                        <label>@lang('site.first_name')</label>
                                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.last_name')</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.image')</label>
                                        <input type="file" name="image" class="form-control image">
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.password')</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.password_confirmation')</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                  

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                                    </div>

                                </form><!-- end of form -->

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    </section><!-- end of content -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

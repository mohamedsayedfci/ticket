@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.tickets')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.tickets.index') }}"> @lang('site.tickets')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.tickets.store') }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                            </div>
                        @endforeach
                        @if(!auth()->user()->hasRole('users'))
                        <div class="form-group">
                            <label>@lang('site.ticket_owner')</label>
                            <select name="user_id" class="form-control" >
                                @foreach($user as $user)
                                <option value={{$user->id}}>{{$user->first_name.' '.$user->last_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                            @else
                            <input type="text" style="display: none" name="user_id" class="form-control" value="{{ auth()->id() }}">

                        @endif
                        <div class="form-group" style="display: none">
                            <label>@lang('site.ticket_by')</label>
                            <input type="text" name="ticket_by" class="form-control" value="{{auth()->id()}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.ticket_price')</label>
                            <input type="text" name="ticket_price" class="form-control" value="{{ old('ticket_price') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.date')</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                        </div>


                        <div class="form-group">
                            <label>@lang('site.deadline')</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

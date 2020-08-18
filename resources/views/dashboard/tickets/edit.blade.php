@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.tickets')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.tickets.index') }}"> @lang('site.tickets')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.tickets.update', $ticket->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $ticket->translate($locale)->name }}">
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label>@lang('site.ticket_owner')</label>
                            <input type="text" name="ticket_owner" class="form-control" value="{{ $ticket->ticket_owner }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.ticket_by')</label>
                            <input type="text" name="ticket_by" class="form-control" value="{{$ticket->ticket_by }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.ticket_price')</label>
                            <input type="text" name="ticket_price" class="form-control" value="{{ $ticket->ticket_price }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.date')</label>
                            <input type="text" name="date" class="form-control" value="{{ $ticket->date }}">
                        </div>


                        <div class="form-group">
                            <label>@lang('site.deadline')</label>
                            <input type="text" name="deadline" class="form-control" value="{{ $ticket->deadline }}">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

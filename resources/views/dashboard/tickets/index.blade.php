@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.tickets')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.tickets')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.tickets') <small></small></h3>

                    <form action="{{ route('dashboard.tickets.index') }}" method="get">

                        <div class="row">



                            <div class="form-group col-sm-4">
                                <label class="control-label col-sm-2 "  for="name"> من </label>

                                <div class="col-sm-9 " style="text-align:right">

                                    <input type="date" style="text-align:right" class="form-control "  id="name" value="" placeholder="Enter name" name="from_date">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="control-label col-sm-2 "  for="name">الي  </label>

                                <div class="col-sm-9 " style="text-align:right">

                                    <input  type="date" class="form-control "  id="name" value="" placeholder="Enter name" name="to_date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_tickets'))
                                    <a href="{{ route('dashboard.tickets.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($tickets->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.active')</th>

                                <th>@lang('site.ticket_price')</th>
                                <th>@lang('site.date')</th>
                                <th>@lang('site.deadline')</th>


                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($tickets as $index=>$category)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>

                                    <td>{{ $category->getactive() }}</td>
                                    <td>{{ $category->ticket_price }}</td>
                                    <td>{{ $category->date }}</td>
                                    <td>{{ $category->deadline }}</td>

                                   <td>
                                        @if (auth()->user()->hasPermission('update_tickets'))
                                            <a href="{{ route('dashboard.tickets.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <a href="{{ route('dashboard.tickets.changeStatus', $category->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.changeStatus')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.changeStatus')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_tickets'))
                                            <form action="{{ route('dashboard.tickets.destroy', $category->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->


                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
{{ trans("admin/users/general.title") }} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ trans("admin/users/general.title") }}

		<div class="pull-right">
			<a href="{{ route('create/user') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{ trans('button.create') }}</a>
		</div>
	</h3>
</div>

{{ $users->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span2">{{ trans('admin/users/table.first_name') }}</th>
			<th class="span2">{{ trans('admin/users/table.last_name') }}</th>
			<th class="span3">{{ trans('admin/users/table.email') }}</th>
			<th class="span2">{{ trans('admin/users/table.activated') }}</th>
			<th class="span2">{{ trans('admin/users/table.created_at') }}</th>
			<th class="span2">{{ trans('table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
		@if ($users->count() >= 1)
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->first_name }}</td>
			<td>{{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ trans('general.' . ($user->isActivated() ? 'yes' : 'no')) }}</td>
			<td>{{ $user->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/user', $user->id) }}" class="btn btn-mini tip" title="{{ trans('button.edit') }}">{{ trans('button.edit') }}</a>

				@if ( ! is_null($user->deleted_at))
				<a href="{{ route('restore/user', $user->id) }}" class="btn btn-mini btn-warning tip" title="{{ trans('button.restore') }}">{{ trans('button.restore') }}</a>
				@elseif (Sentry::getId() !== $user->id)
				<a href="{{ route('delete/user', $user->id) }}" class="btn btn-mini btn-danger tip" title="{{ trans('button.delete') }}">{{ trans('button.delete') }}</a>
				@else
				<span class="btn btn-mini btn-danger disabled">{{ trans('button.delete') }}</span>
				@endif
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="6">{{ trans('table.no_results') }}</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $users->links() }}
@stop

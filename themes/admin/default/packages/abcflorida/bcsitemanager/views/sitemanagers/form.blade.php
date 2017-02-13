@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('abcflorida/bcsitemanager::sitemanagers/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('page')

<section class="panel panel-default panel-tabs">

	{{-- Form --}}
	<form id="bcsitemanager-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate>

		{{-- Form: CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<header class="panel-heading">

			<nav class="navbar navbar-default navbar-actions">

				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="btn btn-navbar-cancel navbar-btn pull-left tip" href="{{ route('admin.abcflorida.bcsitemanager.sitemanagers.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
							<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
						</a>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $sitemanager->exists ? $sitemanager->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($sitemanager->exists)
							<li>
								<a href="{{ route('admin.abcflorida.bcsitemanager.sitemanagers.delete', $sitemanager->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
									<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
								</button>
							</li>

						</ul>

					</div>

				</div>

			</nav>

		</header>

		<div class="panel-body">

			<div role="tabpanel">

				{{-- Form: Tabs --}}
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" role="presentation"><a href="#general-tab" aria-controls="general-tab" role="tab" data-toggle="tab">{{{ trans('abcflorida/bcsitemanager::sitemanagers/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('abcflorida/bcsitemanager::sitemanagers/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Tab: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general-tab">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('sitename', ' has-error') }}">

									<label for="sitename" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.sitename_help') }}}"></i>
										{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.sitename') }}}
									</label>

									<textarea class="form-control" name="sitename" id="sitename" placeholder="{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.sitename') }}}">{{{ input()->old('sitename', $sitemanager->sitename) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('sitename') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('bucketname', ' has-error') }}">

									<label for="bucketname" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.bucketname_help') }}}"></i>
										{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.bucketname') }}}
									</label>

									<textarea class="form-control" name="bucketname" id="bucketname" placeholder="{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.bucketname') }}}">{{{ input()->old('bucketname', $sitemanager->bucketname) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('bucketname') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('isactive', ' has-error') }}">

									<label for="isactive" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.isactive_help') }}}"></i>
										{{{ trans('abcflorida/bcsitemanager::sitemanagers/model.general.isactive') }}}
									</label>

									<div class="checkbox">
										<label>
											<input type="hidden" name="isactive" id="isactive" value="0" checked>
											<input type="checkbox" name="isactive" id="isactive" @if($sitemanager->isactive) checked @endif value="1"> {{ ucfirst('isactive') }}
										</label>
									</div>

									<span class="help-block">{{{ Alert::onForm('isactive') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Tab: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($sitemanager)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop

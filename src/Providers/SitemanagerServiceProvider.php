<?php namespace Abcflorida\Bcsitemanager\Providers;

use Cartalyst\Support\ServiceProvider;

class SitemanagerServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Abcflorida\Bcsitemanager\Models\Sitemanager']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('abcflorida.bcsitemanager.sitemanager.handler.event');
                
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('abcflorida.bcsitemanager.sitemanager', 'Abcflorida\Bcsitemanager\Repositories\Sitemanager\SitemanagerRepository');

		// Register the data handler
		$this->bindIf('abcflorida.bcsitemanager.sitemanager.handler.data', 'Abcflorida\Bcsitemanager\Handlers\Sitemanager\SitemanagerDataHandler');

		// Register the event handler
		$this->bindIf('abcflorida.bcsitemanager.sitemanager.handler.event', 'Abcflorida\Bcsitemanager\Handlers\Sitemanager\SitemanagerEventHandler');

		// Register the validator
		$this->bindIf('abcflorida.bcsitemanager.sitemanager.validator', 'Abcflorida\Bcsitemanager\Validator\Sitemanager\SitemanagerValidator');
	}

}

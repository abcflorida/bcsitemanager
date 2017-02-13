<?php namespace Abcflorida\Bcsitemanager\Handlers\Sitemanager;

use Illuminate\Events\Dispatcher;
use Abcflorida\Bcsitemanager\Models\Sitemanager;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class SitemanagerEventHandler extends BaseEventHandler implements SitemanagerEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.creating', __CLASS__.'@creating');
		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.created', __CLASS__.'@created');

		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.updating', __CLASS__.'@updating');
		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.updated', __CLASS__.'@updated');

		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.deleted', __CLASS__.'@deleting');
		$dispatcher->listen('abcflorida.bcsitemanager.sitemanager.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(Sitemanager $sitemanager)
	{
		$this->flushCache($sitemanager);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Sitemanager $sitemanager, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Sitemanager $sitemanager)
	{
		$this->flushCache($sitemanager);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleting(Sitemanager $sitemanager)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Sitemanager $sitemanager)
	{
		$this->flushCache($sitemanager);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @return void
	 */
	protected function flushCache(Sitemanager $sitemanager)
	{
		$this->app['cache']->forget('abcflorida.bcsitemanager.sitemanager.all');

		$this->app['cache']->forget('abcflorida.bcsitemanager.sitemanager.'.$sitemanager->id);
	}

}

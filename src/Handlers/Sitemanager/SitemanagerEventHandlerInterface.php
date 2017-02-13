<?php namespace Abcflorida\Bcsitemanager\Handlers\Sitemanager;

use Abcflorida\Bcsitemanager\Models\Sitemanager;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface SitemanagerEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a sitemanager is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a sitemanager is created.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @return mixed
	 */
	public function created(Sitemanager $sitemanager);

	/**
	 * When a sitemanager is being updated.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Sitemanager $sitemanager, array $data);

	/**
	 * When a sitemanager is updated.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @return mixed
	 */
	public function updated(Sitemanager $sitemanager);

	/**
	 * When a sitemanager is being deleted.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @return mixed
	 */
	public function deleting(Sitemanager $sitemanager);

	/**
	 * When a sitemanager is deleted.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Models\Sitemanager  $sitemanager
	 * @return mixed
	 */
	public function deleted(Sitemanager $sitemanager);

}

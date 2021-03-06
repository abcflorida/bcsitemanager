<?php namespace Abcflorida\Bcsitemanager\Handlers\Sitemanager;

interface SitemanagerDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}

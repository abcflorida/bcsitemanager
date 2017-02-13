<?php namespace Abcflorida\Bcsitemanager\Repositories\Sitemanager;

interface SitemanagerRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Abcflorida\Bcsitemanager\Models\Sitemanager
	 */
	public function grid();

	/**
	 * Returns all the bcsitemanager entries.
	 *
	 * @return \Abcflorida\Bcsitemanager\Models\Sitemanager
	 */
	public function findAll();

	/**
	 * Returns a bcsitemanager entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Abcflorida\Bcsitemanager\Models\Sitemanager
	 */
	public function find($id);

	/**
	 * Determines if the given bcsitemanager is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given bcsitemanager is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given bcsitemanager.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a bcsitemanager entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Abcflorida\Bcsitemanager\Models\Sitemanager
	 */
	public function create(array $data);

	/**
	 * Updates the bcsitemanager entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Abcflorida\Bcsitemanager\Models\Sitemanager
	 */
	public function update($id, array $data);

	/**
	 * Deletes the bcsitemanager entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}

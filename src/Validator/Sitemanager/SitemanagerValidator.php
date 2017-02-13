<?php namespace Abcflorida\Bcsitemanager\Validator\Sitemanager;

use Cartalyst\Support\Validator;

class SitemanagerValidator extends Validator implements SitemanagerValidatorInterface {

	/**
	 * {@inheritDoc}
	 */
	protected $rules = [
               'id' => 'integer',
	];

	/**
	 * {@inheritDoc}
	 */
	public function onUpdate()
	{

	}

}

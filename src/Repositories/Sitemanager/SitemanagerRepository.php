<?php namespace Abcflorida\Bcsitemanager\Repositories\Sitemanager;

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;

class SitemanagerRepository implements SitemanagerRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Abcflorida\Bcsitemanager\Handlers\Sitemanager\SitemanagerDataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent bcsitemanager model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->setContainer($app);

		$this->setDispatcher($app['events']);

		$this->data = $app['abcflorida.bcsitemanager.sitemanager.handler.data'];

		$this->setValidator($app['abcflorida.bcsitemanager.sitemanager.validator']);

		$this->setModel(get_class($app['Abcflorida\Bcsitemanager\Models\Sitemanager']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever('abcflorida.bcsitemanager.sitemanager.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('abcflorida.bcsitemanager.sitemanager.'.$id, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new sitemanager
		$sitemanager = $this->createModel();

		// Fire the 'abcflorida.bcsitemanager.sitemanager.creating' event
		if ($this->fireEvent('abcflorida.bcsitemanager.sitemanager.creating', [ $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForCreation($data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the sitemanager
			$sitemanager->fill($data)->save();

			// Fire the 'abcflorida.bcsitemanager.sitemanager.created' event
			$this->fireEvent('abcflorida.bcsitemanager.sitemanager.created', [ $sitemanager ]);
		}

		return [ $messages, $sitemanager ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the sitemanager object
		$sitemanager = $this->find($id);

		// Fire the 'abcflorida.bcsitemanager.sitemanager.updating' event
		if ($this->fireEvent('abcflorida.bcsitemanager.sitemanager.updating', [ $sitemanager, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($sitemanager, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the sitemanager
			$sitemanager->fill($data)->save();

			// Fire the 'abcflorida.bcsitemanager.sitemanager.updated' event
			$this->fireEvent('abcflorida.bcsitemanager.sitemanager.updated', [ $sitemanager ]);
		}

		return [ $messages, $sitemanager ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the sitemanager exists
		if ($sitemanager = $this->find($id))
		{
			// Fire the 'abcflorida.bcsitemanager.sitemanager.deleting' event
			$this->fireEvent('abcflorida.bcsitemanager.sitemanager.deleting', [ $sitemanager ]);

			// Delete the sitemanager entry
			$sitemanager->delete();

			// Fire the 'abcflorida.bcsitemanager.sitemanager.deleted' event
			$this->fireEvent('abcflorida.bcsitemanager.sitemanager.deleted', [ $sitemanager ]);

			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}
        
        /**
	 * {@inheritDoc}
	 */
	public function findByName($sitename)
	{

               return $this->createModel()->where('sitename', $sitename)->firstorfail();
                
	}

}

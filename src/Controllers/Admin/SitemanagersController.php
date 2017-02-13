<?php namespace Abcflorida\Bcsitemanager\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Abcflorida\Bcsitemanager\Repositories\Sitemanager\SitemanagerRepositoryInterface;
use Cartalyst\Sentinel\Sentinel;
use App;
use Cartalyst\Themes\Laravel\Facades\Asset;

class SitemanagersController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Bcsitemanager repository.
	 *
	 * @var \Abcflorida\Bcsitemanager\Repositories\Sitemanager\SitemanagerRepositoryInterface
	 */
	protected $sitemanagers;

	/**
	 * Holds all the mass actions we can execute.
	 *
	 * @var array
	 */
	protected $actions = [
		'delete',
		'enable',
		'disable',
	];

	/**
	 * Constructor.
	 *
	 * @param  \Abcflorida\Bcsitemanager\Repositories\Sitemanager\SitemanagerRepositoryInterface  $sitemanagers
	 * @return void
	 */
	public function __construct(SitemanagerRepositoryInterface $sitemanagers, Sentinel $auth)
	{
            // This is critical
            parent::__construct();
            //echo session()->get('admin.current_site');
            if ( session()->get('admin.current_site') == null ) {
                echo 'test';
                session()->put('admin.current_site', config('abcflorida.sitemanager.sitedomain'));
                session()->save();
            }
            
            $this->sitemanagers = $sitemanagers;
           
	}

	/**
	 * Display a listing of sitemanager.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index( ) {
            
            $smanagers = $this->sitemanagers->findAll();
            
            $current_site = session()->get('admin.current_site');
            
            Asset::queue('script', 'abcflorida/bcsitemanager::js/script.js', array('bootstrap', 'jquery'));
                        
            return view('abcflorida/bcsitemanager::sitemanagers.index', compact('smanagers', 'current_site') );
            		
	}
        
        // validate the update parameters then do the update
        public function updateSessionCurrentSite ( ) {
            
            $currentSite = request()->get('current_site');
             
           
            
            $messages = $this->sitemanagers->validForUpdate($this->sitemanagers, ['id'=>$currentSite]);
                                
            if (  count($messages) > 0 ) {
               
                $msg = $messages;
                
            } else {
                
                $site = $this->sitemanagers->find( $currentSite );
                $sitename = $site->sitename;
                
                session( )->put('admin.current_site', $sitename );
                session( )->put('admin.current_site_id', $currentSite );
                
                $msg = 'Site Updated to ' . $sitename;
            }
            
            if ( request()->ajax() ) {
                
                return view('abcflorida/bcsitemanager::sitemanagers.partials.alerts', compact('msg'));
                
            }          
            else { 
                     
                
                
                $this->alerts->{'success'}(
			trans("abcflorida/bcsitemanager::sitemanagers/message.success.update")
		);
                        
                return redirect()->route('admin.abcflorida.bcsitemanager.sitemanagers.all');      
                
            }
            
            
            
        }
        

	/**
	 * Datasource for the sitemanager Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->sitemanagers->grid();

		$columns = [
			'id',
			'sitename',
			'bucketname',
			'isactive',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.abcflorida.bcsitemanager.sitemanagers.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new sitemanager.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new sitemanager.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating sitemanager.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating sitemanager.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified sitemanager.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->sitemanagers->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("abcflorida/bcsitemanager::sitemanagers/message.{$type}.delete")
		);

		return redirect()->route('admin.abcflorida.bcsitemanager.sitemanagers.all');
	}

	/**
	 * Executes the mass action.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function executeAction()
	{
		$action = request()->input('action');

		if (in_array($action, $this->actions))
		{
			foreach (request()->input('rows', []) as $row)
			{
				$this->sitemanagers->{$action}($row);
			}

			return response('Success');
		}

		return response('Failed', 500);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		// Do we have a sitemanager identifier?
		if (isset($id))
		{
			if ( ! $sitemanager = $this->sitemanagers->find($id))
			{
				$this->alerts->error(trans('abcflorida/bcsitemanager::sitemanagers/message.not_found', compact('id')));

				return redirect()->route('admin.abcflorida.bcsitemanager.sitemanagers.all');
			}
		}
		else
		{
			$sitemanager = $this->sitemanagers->createModel();
		}

		// Show the page
		return view('abcflorida/bcsitemanager::sitemanagers.form', compact('mode', 'sitemanager'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		// Store the sitemanager
		list($messages) = $this->sitemanagers->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("abcflorida/bcsitemanager::sitemanagers/message.success.{$mode}"));

			return redirect()->route('admin.abcflorida.bcsitemanager.sitemanagers.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}
        
        public function setSite( App $app ) {
            
            //dd( $app );
            
        }

}

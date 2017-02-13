<?php namespace Abcflorida\Bcsitemanager\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;
use Abcflorida\Bcsitemanager\Repositories\Sitemanager\SitemanagerRepository;
use Cartalyst\Sentinel\Sentinel;


class SitemanagersController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
        public function __construct(SitemanagerRepository $sitemanager, Sentinel $auth) {
            parent::__construct();
            
            $this->sitemanager = $sitemanager; 
            $this->auth = $auth;
        }
    
	public function index( )
	{
            
            
            //dd( $this->auth );
            
            if ($this->auth->hasAnyAccess(['sitemanager.index','sitemanager.create','sitemanager.update']))
            {
                
                echo 'yep';
                
            }
            echo config('abcflorida.sitemanager.site');
            
            $site = $this->sitemanager->findByName( config('abcflorida.sitemanager.site') );
            
            return view('abcflorida/bcsitemanager::index');
            
            
	}

}

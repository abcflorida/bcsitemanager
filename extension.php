<?php

use Illuminate\Foundation\Application;
use Cartalyst\Extensions\ExtensionInterface;
use Cartalyst\Settings\Repository as Settings;
use Cartalyst\Permissions\Container as Permissions;
use Abcflorida\Bcsitemanager\Models\Sitemanager as SiteManager;

return [

	/*
	|--------------------------------------------------------------------------
	| Name
	|--------------------------------------------------------------------------
	|
	| This is your extension name and it is only required for
	| presentational purposes.
	|
	*/

	'name' => 'Bcsitemanager',
        'site' => filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING),

	/*
	|--------------------------------------------------------------------------
	| Slug
	|--------------------------------------------------------------------------
	|
	| This is your extension unique identifier and should not be changed as
	| it will be recognized as a new extension.
	|
	| Ideally, this should match the folder structure within the extensions
	| folder, but this is completely optional.
	|
	*/

	'slug' => 'abcflorida/bcsitemanager',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'Brian',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'Mult Site Admin',

	/*
	|--------------------------------------------------------------------------
	| Version
	|--------------------------------------------------------------------------
	|
	| Version should be a string that can be used with version_compare().
	| This is how the extensions versions are compared.
	|
	*/

	'version' => '0.1.0',

	/*
	|--------------------------------------------------------------------------
	| Requirements
	|--------------------------------------------------------------------------
	|
	| List here all the extensions that this extension requires to work.
	| This is used in conjunction with composer, so you should put the
	| same extension dependencies on your main composer.json require
	| key, so that they get resolved using composer, however you
	| can use without composer, at which point you'll have to
	| ensure that the required extensions are available.
	|
	*/

	'require' => [],

	/*
	|--------------------------------------------------------------------------
	| Autoload Logic
	|--------------------------------------------------------------------------
	|
	| You can define here your extension autoloading logic, it may either
	| be 'composer', 'platform' or a 'Closure'.
	|
	| If composer is defined, your composer.json file specifies the autoloading
	| logic.
	|
	| If platform is defined, your extension receives convetion autoloading
	| based on the Platform standards.
	|
	| If a Closure is defined, it should take two parameters as defined
	| bellow:
	|
	|	object \Composer\Autoload\ClassLoader      $loader
	|	object \Illuminate\Foundation\Application  $app
	|
	| Supported: "composer", "platform", "Closure"
	|
	*/

	'autoload' => 'composer',

	/*
	|--------------------------------------------------------------------------
	| Service Providers
	|--------------------------------------------------------------------------
	|
	| Define your extension service providers here. They will be dynamically
	| registered without having to include them in app/config/app.php.
	|
	*/

	'providers' => [

		'Abcflorida\Bcsitemanager\Providers\SitemanagerServiceProvider',

	],

	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| any custom routing logic here.
	|
	| The closure parameters are:
	|
	|	object \Cartalyst\Extensions\ExtensionInterface  $extension
	|	object \Illuminate\Foundation\Application        $app
	|
	*/

	'routes' => function(ExtensionInterface $extension, Application $app)
	{
		Route::group([
				'prefix'    => admin_uri().'/bcsitemanager/sitemanagers',
				'namespace' => 'Abcflorida\Bcsitemanager\Controllers\Admin',
			], function()
			{
                                Route::get('/updatecurrentsite', ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.updatecurrentsite', 'uses' => 'SitemanagersController@updateSessionCurrentSite']);
				Route::get('/' , ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.all', 'uses' => 'SitemanagersController@index']);
				Route::post('/', ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.all', 'uses' => 'SitemanagersController@executeAction']);

				Route::get('grid', ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.grid', 'uses' => 'SitemanagersController@grid']);

				Route::get('create' , ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.create', 'uses' => 'SitemanagersController@create']);
				Route::post('create', ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.create', 'uses' => 'SitemanagersController@store']);

				Route::get('{id}'   , ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.edit'  , 'uses' => 'SitemanagersController@edit']);
				Route::post('{id}'  , ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.edit'  , 'uses' => 'SitemanagersController@update']);

				Route::delete('{id}', ['as' => 'admin.abcflorida.bcsitemanager.sitemanagers.delete', 'uses' => 'SitemanagersController@delete']);
                                
                                
                                //Route::get('/updatecurrentsite', 'SitemanagersController@updateSessionCurrentSite')->name('admin.abcflorida.bcsitemanager.sitemanagers.updatecurrentsite');
			});

		Route::group([
			'prefix'    => 'bcsitemanager/sitemanagers',
			'namespace' => 'Abcflorida\Bcsitemanager\Controllers\Frontend',
		], function()
		{
			Route::get('/', ['as' => 'abcflorida.bcsitemanager.sitemanagers.index', 'uses' => 'SitemanagersController@index']);
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Database Seeds
	|--------------------------------------------------------------------------
	|
	| Platform provides a very simple way to seed your database with test
	| data using seed classes. All seed classes should be stored on the
	| `database/seeds` directory within your extension folder.
	|
	| The order you register your seed classes on the array below
	| matters, as they will be ran in the exact same order.
	|
	| The seeds array should follow the following structure:
	|
	|	Vendor\Namespace\Database\Seeds\FooSeeder
	|	Vendor\Namespace\Database\Seeds\BarSeeder
	|
	*/

	'seeds' => [

	],

	/*
	|--------------------------------------------------------------------------
	| Permissions
	|--------------------------------------------------------------------------
	|
	| Register here all the permissions that this extension has. These will
	| be shown in the user management area to build a graphical interface
	| where permissions can be selected to allow or deny user access.
	|
	| For detailed instructions on how to register the permissions, please
	| refer to the following url https://cartalyst.com/manual/permissions
	|
	*/

	'permissions' => function(Permissions $permissions)
	{
		$permissions->group('sitemanager', function($g)
		{
			$g->name = 'Sitemanagers';

			$g->permission('sitemanager.index', function($p)
			{
				$p->label = trans('abcflorida/bcsitemanager::sitemanagers/permissions.index');

				$p->controller('Abcflorida\Bcsitemanager\Controllers\Admin\SitemanagersController', 'index, grid');
			});

			$g->permission('sitemanager.create', function($p)
			{
				$p->label = trans('abcflorida/bcsitemanager::sitemanagers/permissions.create');

				$p->controller('Abcflorida\Bcsitemanager\Controllers\Admin\SitemanagersController', 'create, store');
			});

			$g->permission('sitemanager.edit', function($p)
			{
				$p->label = trans('abcflorida/bcsitemanager::sitemanagers/permissions.edit');

				$p->controller('Abcflorida\Bcsitemanager\Controllers\Admin\SitemanagersController', 'edit, update');
			});

			$g->permission('sitemanager.delete', function($p)
			{
				$p->label = trans('abcflorida/bcsitemanager::sitemanagers/permissions.delete');

				$p->controller('Abcflorida\Bcsitemanager\Controllers\Admin\SitemanagersController', 'delete');
			});
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Widgets
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| all your custom widgets here. Of course, Platform will guess the
	| widget class for you, this is just for custom widgets or if you
	| do not wish to make a new class for a very small widget.
	|
	*/

	'widgets' => function()
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	|
	| Register any settings for your extension. You can also configure
	| the namespace and group that a setting belongs to.
	|
         * now we are getting the settings by sitemanager
	*/
        /* 'settings' => function (Settings $settings, Application $app) {
            
        $siteManager = SiteManager::all();

            foreach ( $siteManager as $site ) {
                             
                $settings->find('platform')->section('multisite'.$site['sitename'], function ($s) use($site) {
                    $s->name = trans('Multi-Site'.$site['sitename']);

                    $s->fieldset('admin', function ($f) use ($site) {
                        
                        $f->name = trans('platform/settings::settings.admin.title');

                        $f->field('help', function ($f) use ($site) {
                            
                            $f->name   = trans('platform/settings::settings.admin.field.help');
                            $f->type   = 'radio';
                            $f->config = $site['sitename'] . '.platform.app.help';

                            $f->option('no', function ($o) {
                                $o->value = false;
                                $o->label = trans('common.no');
                            });

                            $f->option('yes', function ($o) {
                                $o->value = true;
                                $o->label = trans('common.yes');
                            });
                        });
                    });

                    $s->fieldset('app', function ($f) use ($site) {
                        $f->name = trans('platform/settings::settings.application.title');

                        $f->field('title', function ($f) use ($site) {
                            $f->name   = trans('platform/settings::settings.application.field.title');
                            $f->rules  = 'required';
                            $f->config = $site['sitename'] . '.platform.app.title';
                        });

                        $f->field('tagline', function ($f) use ($site) {
                            $f->name   = trans('platform/settings::settings.application.field.tagline');
                            $f->type   = 'textarea';
                            $f->config = $site['sitename'] . '.platform.app.tagline';
                        });

                        $f->field('copyright', function ($f) use ($site) {
                            $f->name   = trans('platform/settings::settings.application.field.copyright');
                            $f->config = $site['sitename'] . '.platform.app.copyright';
                        });
                    });

                    $s->fieldset('email', function ($f) use ($site) {
                        $f->name = trans('platform/settings::settings.email.title');

                        $f->field('driver', function ($f)  use ($site) {
                            $f->name   = trans('platform/settings::settings.email.field.driver');
                            $f->config = $site['sitename'] . '.mail.driver';

                            $f->option('mail', function ($o) {
                                $o->value = 'mail';
                                $o->label = 'PHP mail()';
                            });

                            $f->option('smtp', function ($o) {
                                $o->value = 'smtp';
                                $o->label = 'SMTP';
                            });

                            $f->option('sendmail', function ($o) {
                                $o->value = 'sendmail';
                                $o->label = 'Sendmail';
                            });

                            $f->option('mailgun', function ($o) {
                                $o->value = 'mailgun';
                                $o->label = 'Mailgun';
                            });

                            $f->option('mandrill', function ($o) {
                                $o->value = 'mandrill';
                                $o->label = 'Mandrill';
                            });

                            $f->option('log', function ($o) {
                                $o->value = 'log';
                                $o->label = 'Log';
                            });
                        });

                        $f->field('host', function ($f) use ($site) {
                            $f->name   = trans('platform/settings::settings.email.field.host');
                            $f->config = $site['sitename'] . '.mail.host';
                        });

                        $f->field('port', function ($f) use ($site)  {
                            $f->name   = trans('platform/settings::settings.email.field.port');
                            $f->config = $site['sitename'] . '.mail.port';
                        });

                        $f->field('encryption', function ($f)  use ($site) {
                            $f->name   = trans('platform/settings::settings.email.field.encryption');
                            $f->config = $site['sitename'] . '.mail.encryption';

                            $f->option('disabled', function ($o) {
                                $o->value = '';
                                $o->label = trans('common.disabled');
                            });

                            $f->option('tls', function ($o) {
                                $o->value = 'tls';
                                $o->label = 'TLS';
                            });

                            $f->option('ssl', function ($o) {
                                $o->value = 'ssl';
                                $o->label = 'SSL';
                            });
                        });

                        $f->field('from_address', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.from_address');
                            $f->config = $site['sitename'] . '.mail.from.address';
                        });

                        $f->field('from_name', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.from_name');
                            $f->config = $site['sitename'] . '.mail.from.name';
                        });

                        $f->field('username', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.username');
                            $f->config = $site['sitename'] . '.mail.username';
                        });

                        $f->field('password', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.password');
                            $f->config = $site['sitename'] . '.mail.password';
                        });

                        $f->field('sendmail', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.sendmail_path');
                            $f->config = $site['sitename'] . '.mail.sendmail';
                        });

                        $f->field('pretend', function ($f) use ( $site ) {
                            $f->name   = trans('platform/settings::settings.email.field.pretend');
                            $f->config = $site['sitename'] . '.mail.pretend';

                            $f->option('enabled', function ($o) {
                                $o->value = true;
                                $o->label = trans('common.enabled');
                            });

                            $f->option('disabled', function ($o) {
                                $o->value = false;
                                $o->label = trans('common.disabled');
                            });
                        });
                    });
                });
            }
    },
            */
        
    

	/*
	|--------------------------------------------------------------------------
	| Menus
	|--------------------------------------------------------------------------
	|
	| You may specify the default various menu hierarchy for your extension.
	| You can provide a recursive array of menu children and their children.
	| These will be created upon installation, synchronized upon upgrading
	| and removed upon uninstallation.
	|
	| Menu children are automatically put at the end of the menu for extensions
	| installed through the Operations extension.
	|
	| The default order (for extensions installed initially) can be
	| found by editing app/config/platform.php.
	|
	*/

	'menus' => [

		'admin' => [
			[
				'slug' => 'admin-abcflorida-bcsitemanager',
				'name' => 'Bcsitemanager',
				'class' => 'fa fa-circle-o',
				'uri' => 'bcsitemanager',
				'regex' => '/:admin\/bcsitemanager/i',
				'children' => [
					[
						'class' => 'fa fa-circle-o',
						'name' => 'Sitemanagers',
						'uri' => 'bcsitemanager/sitemanagers',
						'regex' => '/:admin\/bcsitemanager\/sitemanager/i',
						'slug' => 'admin-abcflorida-bcsitemanager-sitemanager',
					],
				],
			],
		],
		'main' => [
			
		],
	],

];

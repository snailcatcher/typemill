<?php

namespace Typemill\Controllers;

use Typemill\Models\Navigation;
use Typemill\Models\Extension;
use Typemill\Models\User;
use Typemill\Models\License;
use Typemill\Static\Settings;

class ControllerWebSystem extends Controller
{	
	public function showSettings($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$systemfields 		= Settings::getSettingsDefinitions();

		# add full url for sitemap to settings
		$this->settings['sitemap'] = $this->c->get('urlinfo')['baseurl'] . '/cache/sitemap.xml';

	    return $this->c->get('view')->render($response, 'system/system.twig', [
#			'captcha' 			=> $this->checkIfAddCaptcha(),
#			'basicauth'			=> $user->getBasicAuth(),
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'settings' 		=> $this->settings,
										'system'		=> $systemfields,
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function showThemes($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$extension 			= new Extension();
		$themeDefinitions 	= $extension->getThemeDetails();
		$themeSettings 		= $extension->getThemeSettings($this->settings['themes']);

		$license = [];
		if(is_array($this->settings['license']))
		{
			$license = array_keys($this->settings['license']);
		}

	    return $this->c->get('view')->render($response, 'system/themes.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'settings' 		=> $themeSettings,
										'definitions'	=> $themeDefinitions,
										'theme'			=> $this->settings['theme'],
										'license' 		=> $license,
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function showPlugins($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$extension 			= new Extension();
		$pluginDefinitions 	= $extension->getPluginDetails();
		$pluginSettings 	= $extension->getPluginSettings($this->settings['plugins']);

		$license = [];
		if(is_array($this->settings['license']))
		{
			$license = array_keys($this->settings['license']);
		}

	    return $this->c->get('view')->render($response, 'system/plugins.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'settings' 		=> $pluginSettings,
										'definitions'	=> $pluginDefinitions,
										'license'		=> $license,
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function showLicense($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$license 		= new License();
		$licensefields 	= $license->getLicenseFields();
		$licensedata 	= $license->getLicenseData($this->c->get('urlinfo'));
		if($licensedata)
		{
			foreach($licensefields as $key => $licensefield)
			{
				$licensefields[$key]['disabled'] = true;
			}
		}

	    return $this->c->get('view')->render($response, 'system/license.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'licensedata' 	=> $licensedata,
										'licensefields'	=> $licensefields,
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')							]
	    ]);
	}

	public function showAccount($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$username			= $request->getAttribute('c_username');
		$user				= new User();
		$user->setUser($username);

		$userdata			= $user->getUserData();
		$userfields 		= $user->getUserFields($this->c->get('acl'), $userdata['userrole']);

	    return $this->c->get('view')->render($response, 'system/account.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'userdata'		=> $userdata,
										'userfields'	=> $userfields,
										'userroles'		=> $this->c->get('acl')->getRoles(),
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function showUsers($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$user				= new User();
		$usernames			= $user->getAllUsers();
		$userdata			= [];
		$count 				= 0;
		foreach($usernames as $username)
		{
			if($count == 10) break;
			$user->setUser($username);
			$userdata[] = $user->getUserData();
			$count++;
		}

	    return $this->c->get('view')->render($response, 'system/users.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'totalusers'	=> count($usernames),
										'usernames' 	=> $usernames,
										'userdata'		=> $userdata,
										'userroles'		=> $this->c->get('acl')->getRoles(),
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function showUser($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

		$user				= new User();
		$username			= $args['username'] ?? false;
		if(!$user->setUser($username))
		{
			die("return a not found page");
		}

		$userdata			= $user->getUserData();
		$inspector 			= $request->getAttribute('c_userrole');
		$userfields 		= $user->getUserFields($this->c->get('acl'), $userdata['userrole'], $inspector);

	    return $this->c->get('view')->render($response, 'system/user.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'userdata'		=> $userdata,
										'userfields'	=> $userfields,
										'userroles'		=> $this->c->get('acl')->getRoles(),
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}

	public function newUser($request, $response, $args)
	{
		$navigation 		= new Navigation();
		$mainNavigation		= $navigation->getMainNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo'),
									$editor 	= $this->settings['editor']
								);

		$systemNavigation	= $navigation->getSystemNavigation(
									$userrole 	= $request->getAttribute('c_userrole'),
									$acl 		= $this->c->get('acl'),
									$urlinfo 	= $this->c->get('urlinfo')
								);

	    return $this->c->get('view')->render($response, 'system/usernew.twig', [
			'settings' 			=> $this->settings,
			'mainnavi'			=> $mainNavigation,
			'systemnavi'		=> $systemNavigation,
			'jsdata' 			=> [
										'userroles'		=> $this->c->get('acl')->getRoles(),
										'labels'		=> $this->c->get('translations'),
										'urlinfo'		=> $this->c->get('urlinfo')
									]
	    ]);
	}


/*
	public function showBlank($request, $response, $args)
	{
		$user				= new User();
		$settings 			= $this->c->get('settings');
		$route 				= $request->getAttribute('route');
		$navigation 		= $this->getMainNavigation();

		$content 			= '<h1>Hello</h1><p>I am the showBlank method from the settings controller</p><p>In most cases I have been called from a plugin. But if you see this content, then the plugin does not work or has forgotten to inject its own content.</p>';

		return $this->render($response, 'settings/blank.twig', array(
			'settings' 		=> $settings,
			'acl' 			=> $this->c->acl, 
			'navigation'	=> $navigation,
			'content' 		=> $content,
			'route' 		=> $route->getName() 
		));
	}			
*/
}
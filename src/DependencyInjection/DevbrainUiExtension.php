<?php 
namespace Devbrain\Ui\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Devbrain\Ui\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class DevbrainUiExtension extends Extension implements PrependExtensionInterface
{
	/**
	 * Bundle configuration Injection
	 *
	 * @param array $configs
	 * @param ContainerBuilder $container
	 *
	 * @return void
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		// Default Config
		// --
		
		$config = $this->processConfiguration(new Configuration(), $configs);
		$container->setParameter(Configuration::NAME, $config);		
        
		// Bundle config location
		// --
		
		$locator = new FileLocator(__DIR__.'/../Resources/config');
		$loader = new YamlFileLoader($container, $locator);
		
		// Services Injection
		// --
		
		$loader->load('services.yaml');
	}
	
	/**
	 * Prepend some data to the global app configuration
	 *
	 * @param ContainerBuilder $container
	 *
	 * @return void
	 */
	public function prepend(ContainerBuilder $container)
	{
        $twigConfig = [];
        $twigConfig['paths'][__DIR__.'/../Resources/templates'] = "DevbrainUi";
        $container->prependExtensionConfig('twig', $twigConfig);
	}
}
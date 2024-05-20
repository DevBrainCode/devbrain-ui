<?php 
namespace Devbrain\UI\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * define the name of the configuration tree.
	 * > /config/packages/devbrain_ui.yaml
	 *
	 * @var string
	 */
	public const NAME = "devbrain_ui";

	/**
	 * Define the translation domain
	 *
	 * @var string
	 */
	public const DOMAIN = 'devbrain_ui';
	
	/**
	 * Update and return the Configuration Builder
	 *
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder(): TreeBuilder
	{
		$builder = new TreeBuilder( self::NAME );
		$rootNode = $builder->getRootNode();

		// $rootNode->children()

			

		// ->end();
		
		return $builder;
	}
}
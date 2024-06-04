<?php 
namespace Devbrain\Ui\DependencyInjection;

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

		$rootNode->children()

		/**
		 * Cookie Consent Component
		 * --
		 * 
		 * @var array
		 */
		->arrayNode('cookie_box')->addDefaultsIfNotSet()->children()
			
			/**
			 * Storage strategy
			 * --
			 * 
			 * @var string
			 * @default cky
			 */
			->enumNode('strategy')->values(["cookie", "storage"])->defaultValue("cookie")->end()

				
			/**
			 * Cookie Consent Name
			 * --
			 * 
			 * @var string
			 * @default cky
			 */
			->scalarNode('name')->defaultValue('cky')->end()


			->arrayNode('properties')
				->addDefaultsIfNotSet()
				->children()

					/**
					 * Show choice for "necessary" cookie
					 * --
					 * 
					 * @var boolean
					 * @default true
					 */
					->arrayNode('necessary')->children()
						->booleanNode('default')->defaultTrue()->end()
						->booleanNode('customizable')->defaultTrue()->end()
						->booleanNode('disabled')->defaultTrue()->end()
					->end()->end()

					/**
					 * Show choice for "performance" cookie
					 * --
					 * 
					 * @var boolean
					 * @default true
					 */
					->arrayNode('performance')->children()
						->booleanNode('default')->defaultTrue()->end()
						->booleanNode('customizable')->defaultTrue()->end()
						->booleanNode('disabled')->defaultFalse()->end()
					->end()->end()

					/**
					 * Show choice for "functionality" cookie
					 * --
					 * 
					 * @var boolean
					 * @default true
					 */
					->arrayNode('functionality')->children()
						->booleanNode('default')->defaultTrue()->end()
						->booleanNode('customizable')->defaultTrue()->end()
						->booleanNode('disabled')->defaultFalse()->end()
					->end()->end()

					/**
					 * Show choice for "advertising" cookie
					 * --
					 * 
					 * @var boolean
					 * @default true
					 */
					->arrayNode('advertising')->children()
						->booleanNode('default')->defaultTrue()->end()
						->booleanNode('customizable')->defaultTrue()->end()
						->booleanNode('disabled')->defaultFalse()->end()
					->end()->end()

				->end()
			->end()


		->end()->end() // End of cookie_consent

		->end();
		
		return $builder;
	}
}
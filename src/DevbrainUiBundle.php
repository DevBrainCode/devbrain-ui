<?php 
namespace Devbrain\UI;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Devbrain\UI\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DevbrainUiBundle extends Bundle 
{
	public function getRoot(): string
	{
        return $this->container->getParameter('kernel.project_dir');
	}
    
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
		$this->container = $container;

        $this->copyConfigFileToProject();
    }

    private function copyConfigFileToProject(): void
    {
        $filesystem = new Filesystem();
		$configFile = Configuration::NAME.".yaml";
        $originFile = $this->getPath() . '/Resources/config/packages/' . $configFile;
        $targetFile = $this->getRoot() . '/config/packages/' . $configFile;

        if (!file_exists($targetFile))
        {
            $filesystem->copy($originFile, $targetFile, true);
        }
    }
}
<?php 
namespace Devbrain\Ui\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class DocController extends AbstractController
{
    const DOC_DIRECTORY = __DIR__."/../../documentation/data/";

    public function __construct(
        private RequestStack $requestStack
    ){}

    public function index(): Response
    {
        $scandir = scandir(self::DOC_DIRECTORY);
        $documentation = [];
        $navigation = [];

        
        // Documentation Files
        // --

        foreach ($scandir as $file)
        {
            if (str_ends_with($file, ".json"))
            {
                $content = file_get_contents(self::DOC_DIRECTORY.$file);
                $json    = json_decode($content, true);
                $path    = str_replace(".json", '', $file);

                array_push($documentation, array_merge([
                    'path' => $path,
                ], $json));
            }
        }

        
        // Menus
        // --

        foreach ($documentation as $component)
        {
            array_push($navigation, [
                'label' => "{$component['status']} {$component['name']}",
                'path'  => $component['path'],
                'type'  => $component['type'],
            ]);
        }


        $type    = $this->requestStack->getCurrentRequest()->get('type') ?? null;
        $element = $this->requestStack->getCurrentRequest()->get('element') ?? null;
        $item    = array_filter($documentation, fn($item) => $item['type'] === $type && $item['path'] === $element);
        $item    = reset($item);

        // dump($documentation);
        // // dd($navigation);
        // dump($type);
        // dump($element);
        // dd( $item);

        return $this->render("@DevbrainUiDoc/index.html.twig", [
            'navigation' => $navigation,
            'type'       => $type,
            'element'    => $element,
            'item'       => $item,
        ]);
    }
}
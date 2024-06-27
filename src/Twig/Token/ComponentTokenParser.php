<?php 
namespace Devbrain\Ui\Twig\Token;

use Twig\Token;
use Devbrain\Ui\Twig\Node\ComponentNode;
use Twig\TokenParser\AbstractTokenParser;

class ComponentTokenParser extends AbstractTokenParser
{
    public function getTag()
    {
        return 'db_component';
    }

    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        
        // Get component name
        $component = $stream->expect(Token::STRING_TYPE)->getValue();
        
        // Get part
        $part = '';
        if ($stream->nextIf(Token::NAME_TYPE, 'part')) {
            $part = $stream->expect(Token::STRING_TYPE)->getValue();
        }

        // Get options
        $options = new \Twig\Node\Node();
        if ($stream->nextIf(Token::NAME_TYPE, 'with')) {
            $options = $this->parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);
        return new ComponentNode($component, $part, $options, $lineno, $this->getTag());
    }
}

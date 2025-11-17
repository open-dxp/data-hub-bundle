<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\General;

use GraphQL\Error\Error;
use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UnexpectedValueException;

class UploadType extends ScalarType
{
    public string $name = 'Upload';

    public ?string $description =
        'The `Upload` special type represents a file to be uploaded in the same HTTP request as specified by
 [graphql-multipart-request-spec](https://github.com/jaydenseric/graphql-multipart-request-spec).';

    public function serialize($value)
    {
        throw new InvariantViolation('`Upload` cannot be serialized');
    }

    public function parseValue($value)
    {
        if (!$value instanceof UploadedFile) {
            throw new UnexpectedValueException(
                'Could not get uploaded file, be sure to conform to GraphQL multipart request specification. Instead got: ' . Utils::printSafe(
                    $value
                )
            );
        }

        return $value;
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null)
    {
        throw new Error(
            '`Upload` cannot be hardcoded in query, be sure to conform to GraphQL multipart request specification. Instead got: ' . $valueNode->kind,
            $valueNode
        );
    }
}

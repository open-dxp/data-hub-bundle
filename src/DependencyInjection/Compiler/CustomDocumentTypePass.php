<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\DependencyInjection\Compiler;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType\DocumentType;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CustomDocumentTypePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $documentTypeService = $container->getDefinition(DocumentType::class);

        $resolvers = $container->findTaggedServiceIds('opendxp.datahub.graphql.documenttype.customtype');

        $dataTypes = [];

        foreach ($resolvers as $id => $tagEntries) {
            foreach ($tagEntries as $tagEntry) {
                $typeDef = $container->getDefinition($id);
                $dataTypes[$tagEntry['id']] = $typeDef;
            }
        }

        $documentTypeService->addMethodCall('registerCustomDataType', [$dataTypes]);
    }
}

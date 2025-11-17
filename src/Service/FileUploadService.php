<?php


namespace OpenDxp\Bundle\DataHubBundle\Service;

use GraphQL\Error\InvariantViolation;
use GraphQL\Server\RequestError;
use Symfony\Component\HttpFoundation\Request;

class FileUploadService
{
    /**
     *
     *
     * @throws RequestError
     */
    public function parseUploadedFiles(Request $request): array
    {
        $this->validateParsedBody($request);

        $bodyParams = $request->request->all();

        if (!isset($bodyParams['map'])) {
            throw new RequestError('The request must define a `map`');
        }

        $map = json_decode($bodyParams['map'], true);
        $result = json_decode($bodyParams['operations'], true);

        foreach ($map as $fileKey => $locations) {
            foreach ($locations as $location) {
                $items = &$result;

                foreach (explode('.', $location) as $key) {
                    if (!isset($items[$key]) || !is_array($items[$key])) {
                        $items[$key] = [];
                    }

                    $items = &$items[$key];
                }

                $items = $request->files->get($fileKey);
            }
        }

        return $result;
    }

    /**
     * Validates that the request meet our expectations
     *
     *
     */
    protected function validateParsedBody(Request $request): void
    {
        $bodyParams = $request->request->all();

        if (empty($bodyParams)) {
            throw new InvariantViolation(
                'Request is expected to provide parsed body for "multipart/form-data" requests but got empty array'
            );
        }
    }
}

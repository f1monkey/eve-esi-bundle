<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\EventListener;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\Esi\Response\EsiResponseCollection;
use F1monkey\EveEsiBundle\Dto\Esi\Response\HasETagInterface;
use F1monkey\EveEsiBundle\Dto\Esi\Response\HasPageCountInterface;
use F1monkey\EveEsiBundle\Event\RequestAfterEvent;

/**
 * Class EsiRequestMetadataInjectListener
 *
 * @package F1monkey\EveEsiBundle\EventListener
 */
class RequestListener
{
    protected const ETAG_HEADER = 'etag';
    protected const PAGE_COUNT_HEADER = 'x-pages';

    /**
     * @param RequestAfterEvent $event
     */
    public function injectEsiResponseMetadata(RequestAfterEvent $event): void
    {
        $headers = $event->getResponse()->getHeaders();

        $response = $event->getResponseObject();
        if ($response instanceof Collection) {
            $response = new EsiResponseCollection($response->toArray());
        }

        $headersCanonical = [];
        foreach ($headers as $key => $value) {
            $headersCanonical[strtolower($key)] = $value;
        }

        $this->injectETagValue($response, $headersCanonical);
        $this->injectPageCountValue($response, $headersCanonical);

        $event->setResponseObject($response);
    }

    /**
     * @param object     $response
     * @param string[][] $headers
     */
    protected function injectETagValue(object $response, array $headers): void
    {
        if (!$response instanceof HasETagInterface) {
            return;
        }

        if (!isset($headers[static::ETAG_HEADER])) {
            return;
        }

        $eTagHeader = $headers[static::ETAG_HEADER];
        if (is_array($eTagHeader)) {
            $eTagHeader = reset($eTagHeader) ?: null;
        }

        $response->setETag($eTagHeader);
    }

    /**
     * @param object     $response
     * @param string[][] $headers
     */
    protected function injectPageCountValue(object $response, array $headers): void
    {
        if (!$response instanceof HasPageCountInterface) {
            return;
        }

        if (!isset($headers[static::PAGE_COUNT_HEADER])) {
            return;
        }

        $pageCountHeader = $headers[static::PAGE_COUNT_HEADER];
        if (is_array($pageCountHeader)) {
            $pageCountHeader = reset($pageCountHeader);
        }

        $response->setPageCount((int)$pageCountHeader);
    }
}
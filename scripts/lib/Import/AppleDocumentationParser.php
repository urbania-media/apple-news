<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;

class AppleDocumentationParser
{
    public function parse($html, $url)
    {
        $document = new DomDocument($html);

        return $this->isObject($document)
            ? new ObjectDocument($document, $url)
            : new Document($document, $url);
    }

    protected function isObject(DomDocument $document)
    {
        return $this->eyebrowIsObject($document) &&
            $this->isAppleFormat($document);
    }

    protected function eyebrowIsObject(DomDocument $document)
    {
        $eyebrowSelector = '#main .topic-title .eyebrow';
        return $document->has($eyebrowSelector) &&
            strtolower(trim($document->find($eyebrowSelector)[0]->text())) === 'object';
    }

    protected function isAppleFormat(DomDocument $document)
    {
        $technologySelector = '#main .topic-summary .sdks';
        return $document->has($technologySelector) &&
            preg_match(
                '/Apple News Format/',
                $document->find($technologySelector)[0]->text()
            );
    }
}

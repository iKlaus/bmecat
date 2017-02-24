<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

use SE\Component\BMEcat\Node\DocumentNode;
use SE\Component\BMEcat\Exception\MissingDocumentException;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilder
{
    /**
     *
     * @var Serializer
     */
    protected $serializer;

    /**
     *
     * @var SerializationContext
     */
    protected $context;

    /**
     *
     * @var NodeLoader
     */
    protected $loader;

    /**
     *
     * @var DocumentNode
     */
    protected $document;

    /**
     * @param Serializer $serializer
     * @param NodeLoader $loader
     */
    public function __construct(Serializer $serializer = null, NodeLoader $loader = null, $context = null)
    {
        if($serializer === null) {
            $serializer = SerializerBuilder::create()->build();
        }

        if($context === null) {
            $context = SerializationContext::create();
        }


        if($loader === null) {
            $loader = new NodeLoader();
        }

        $this->context    = $context;
        $this->serializer = $serializer;
        $this->loader     = $loader;
    }

    /**
     *
     * @param Serializer $serializer
     * @param NodeLoader $loader
     *
     * @return DocumentBuilder
     */
    public static function create(Serializer $serializer = null, NodeLoader $loader = null)
    {
        return new self($serializer, $loader);
    }

    /**
     *
     * @return NodeLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     *
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     *
     * @return SerializationContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     *
     * @param DocumentNode $document
     *
*@return NodeLoader
     */
    public function setDocument(DocumentNode $document)
    {
        $this->document = $document;
    }

    /**
     *
     * @return DocumentNode
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Builds the BMEcat document tree
     *
     * @return DocumentNode
     */
    public function build()
    {
        if(($document = $this->getDocument()) === null) {
            $document = $this->loader->getInstance(NodeLoader::DOCUMENT_NODE);
            $this->setDocument($document);
        }

        if(($header = $document->getHeader()) === null) {
            $header = $this->loader->getInstance(NodeLoader::HEADER_NODE);
            $document->setHeader($header);
        }

        if(($supplier = $header->getSupplier()) === null) {
            $supplier = $this->loader->getInstance(NodeLoader::SUPPLIER_NODE);
            $header->setSupplier($supplier);
        }

        if(($catalog = $header->getCatalog()) === null) {
            $catalog = $this->loader->getInstance(NodeLoader::CATALOG_NODE);
            $header->setCatalog($catalog);
        }

        if(($datetime = $catalog->getDateTime()) === null) {
            $datetime = $this->loader->getInstance(NodeLoader::DATE_TIME_NODE);
            $catalog->setDateTime($datetime);
        }

        if(($newCatalog = $document->getNewCatalog()) === null) {
            $newCatalog = $this->loader->getInstance(NodeLoader::NEW_CATALOG_NODE);
            $document->setNewCatalog($newCatalog);
        }

        return $document;
    }

    /**
     *
     * @param array $data
     */
    public function load(array $data)
    {
        DataLoader::load($data, $this);
    }

    /**
     *
     * @param $bool
     */
    public function setSerializeNull($bool)
    {
        $this->context->setSerializeNull($bool);
    }
    
    /**
     *
     * @throws MissingDocumentException
     * @return string
     */
    public function toString()
    {
        if(($document = $this->getDocument()) === null) {
            throw new MissingDocumentException('No Document built. Please call ::build first.');
        }

        return $this->serializer->serialize($document, 'xml', $this->context);
    }
}

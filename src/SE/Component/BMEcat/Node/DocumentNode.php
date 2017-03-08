<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Node;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("BMEcat")
 * @Serializer\ExclusionPolicy("all")
 */
class DocumentNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\XmlAttribute
     */
    protected $version = '1.2';

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("xmlns")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $namespace = 'http://www.bmecat.org/bmecat/1.2/bmecat_new_catalog';

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("xmlns:xsi")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $nullableNamespace = 'http://www.w3.org/2001/XMLSchema-instance';

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("xsi:noNamespaceSchemaLocation")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $nullableLocation = 'http://www.w3.org/1999/xhtml.xsd';

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\HeaderNode")
     * @Serializer\SerializedName("HEADER")
     *
     * @var HeaderNode
     */
    protected $header;

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\NewCatalogNode")
     * @Serializer\SerializedName("T_NEW_CATALOG")
     *
     * @var NewCatalogNode
     */
    protected $catalog;

    /**
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param HeaderNode $header
     *
     * @return void
     */
    public function setHeader(HeaderNode $header)
    {
        $this->header = $header;
    }

    /**
     *
     * @return HeaderNode
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param NewCatalogNode $catalog
     *
     * @return void
     */
    public function setNewCatalog(NewCatalogNode $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * @return NewCatalogNode
     */
    public function getNewCatalog()
    {
        return $this->catalog;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNullableNamespace()
    {
        return $this->nullableNamespace;
    }

    /**
     * @param string $nullableNamespace
     */
    public function setNullableNamespace($nullableNamespace)
    {
        $this->nullableNamespace = $nullableNamespace;
    }

    /**
     * @return string
     */
    public function getNullableLocation()
    {
        return $this->nullableLocation;
    }

    /**
     * @param string $nullableLocation
     */
    public function setNullableLocation($nullableLocation)
    {
        $this->nullableLocation = $nullableLocation;
    }
}

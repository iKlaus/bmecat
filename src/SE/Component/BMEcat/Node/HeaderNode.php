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
 * @Serializer\XmlRoot("HEADER")
 */
class HeaderNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("GENERATOR_INFO")
     *
     * @var string
     */
    protected $generatorInfo;

    /**
     * @param string $generatorInfo
     * @return void
     */
    public function setGeneratorInfo($generatorInfo)
    {
        $this->generatorInfo = $generatorInfo;
    }

    /**
     *
     * @return string
     */
    public function getGeneratorInfo()
    {
        return $this->generatorInfo;
    }

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\CatalogNode")
     * @Serializer\SerializedName("CATALOG")
     *
     * @var CatalogNode
     */
    protected $catalog;

    /**
     * @param CatalogNode $catalog
     *
     * @return void
     */
    public function setCatalog(CatalogNode $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * @return CatalogNode $catalog
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\SupplierNode")
     * @Serializer\SerializedName("SUPPLIER")
     *
     * @var SupplierNode
     */
    protected $supplier;

    /**
     * @param SupplierNode $supplier
     *
     * @return void
     */
    public function setSupplier(SupplierNode $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return SupplierNode
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
}

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
 * @Serializer\XmlRoot("ARTICLE")
 */
class ArticleNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("SUPPLIER_AID")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_DETAILS")
     * @Serializer\Type("SE\Component\BMEcat\Node\ArticleDetailsNode")
     *
     * @var ArticleDetailsNode
     */
    protected $detail;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_PRICE_DETAILS")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticlePriceNode>")
     * @Serializer\XmlList( entry="ARTICLE_PRICE")
     *
     * @var ArticlePriceNode[]
     */
    protected $prices = [];

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_FEATURES")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleFeatureNode>")
     * @Serializer\XmlList( entry="FEATURE")
     *
     * @var ArticleFeatureNode[]
     */
    protected $features = [];

    /**
     *
     * @param ArticleDetailsNode $detail
     */
    public function setDetails(ArticleDetailsNode $detail)
    {
        $this->detail = $detail;
    }

    /**
     *
     * @return ArticleDetailsNode
     */
    public function getDetails()
    {
        return $this->detail;
    }

    /**
     *
     * @param ArticleFeatureNode $feature
     */
    public function addFeature(ArticleFeatureNode $feature)
    {
        if($this->features === null) {
            $this->features = [];
        }
        $this->features []= $feature;
    }

    /**
     *
     * @param ArticlePriceNode $price
     */
    public function addPrice(ArticlePriceNode $price)
    {
        if($this->prices === null) {
            $this->prices = [];
        }
        $this->prices []= $price;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullFeatures()
    {
        if(empty($this->features) === true) {
            $this->features = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullPrices()
    {
        if(empty($this->prices) === true) {
            $this->prices = null;
        }
    }

    /**
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return ArticleFeatureNode[]
     */
    public function getFeatures()
    {
        if($this->features === null)  {
            return [];
        }

        return $this->features;
    }

    /**
     *
     * @return ArticlePriceNode[]
     */
    public function getPrices()
    {
        if($this->prices === null)  {
            return [];
        }

        return $this->prices;
    }
}

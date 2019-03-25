<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining a condition that, when met, causes conditional
 * properties to go into effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/condition
 */
class Condition extends BaseSdkObject
{
    /**
     * A string describing the width at which the article is displayed. The
     * value indicates whether the article width is considered constrained
     * (compact) or expansive (regular) by iOS. When the article is displayed
     * at the specified size class, the conditional properties are in effect.
     * The horizontal size class is always regular in macOS.
     * @var string
     */
    protected $horizontalSizeClass;

    /**
     * The maximum number of columns in which the article is displayed. When
     * the article is viewed with the specified number of columns or fewer,
     * the conditional properties are in effect. For more information about
     * the column system, see Planning the Layout for Your Article.
     * @var integer
     */
    protected $maxColumns;

    /**
     * A string indicating a dynamic type size at which text in the article
     * is displayed. When the article is displayed at the specified size or
     * smaller, the conditional properties are in effect. The default content
     * size category in iOS and macOS is L.
     * @var string
     */
    protected $maxContentSizeCategory;

    /**
     * An Apple News Format version that can be used by an Apple News client
     * that is displaying an article. When the Apple News Format version is
     * equal to or less than the specified value, the conditional properties
     * are in effect.
     * @var string
     */
    protected $maxSpecVersion;

    /**
     * A number indicating a width divided by a height. When the aspect ratio
     * of the user’s viewport is the specified value or smaller, the
     * conditional properties are in effect.
     * @var float
     */
    protected $maxViewportAspectRatio;

    /**
     * A number indicating width in points. When the width of the user’s
     * viewport is the specified value or smaller, the conditional properties
     * are in effect.
     * @var integer
     */
    protected $maxViewportWidth;

    /**
     * The minimum number of columns in which the article is displayed. When
     * the article is viewed with the specified number of columns or more,
     * the conditional properties are in effect. For more information about
     * the column system, see Planning the Layout for Your Article.
     * @var integer
     */
    protected $minColumns;

    /**
     * A string indicating a dynamic type size at which text in the article
     * is displayed. When the article is displayed at the specified dynamic
     * type size or greater, the conditional properties are in effect. The
     * default content size category in iOS and macOS is L.
     * @var string
     */
    protected $minContentSizeCategory;

    /**
     * An Apple News Format version that can be used by an Apple News client
     * that is displaying an article. When the Apple News Format version is
     * equal to or greater than the specified value, the conditional
     * properties are in effect.
     * @var string
     */
    protected $minSpecVersion;

    /**
     * A number indicating a width divided by a height. When the aspect ratio
     * of the user’s viewport is the specified value or greater, the
     * conditional properties are in effect.
     * @var float
     */
    protected $minViewportAspectRatio;

    /**
     * A number indicating the width in points. When the width of the
     * user’s viewport is the specified value or greater, the conditional
     * properties are in effect.
     * @var integer
     */
    protected $minViewportWidth;

    /**
     * A platform on which an article can be viewed. When the article is
     * viewed on the specfied platform, the conditional properties are in
     * effect.
     * @var string
     */
    protected $platform;

    /**
     * The type of subscription the user has. When the subscription is of the
     * specified type, the conditional properties are in effect.
     * @var string
     */
    protected $subscriptionStatus;

    /**
     * A string describing the height at which the article is displayed. The
     * value indicates whether the article width is considered constrained
     * (compact) or expansive (regular) by iOS. When the article is displayed
     * at the specified size class, the conditional properties are in effect.
     * The vertical size class is always regular in macOS.
     * @var string
     */
    protected $verticalSizeClass;

    /**
     * The context of the article. When the context is of the specified type,
     * the conditional properties are in effect.
     * @var string
     */
    protected $viewLocation;

    public function __construct(array $data = [])
    {
        if (isset($data['horizontalSizeClass'])) {
            $this->setHorizontalSizeClass($data['horizontalSizeClass']);
        }

        if (isset($data['maxColumns'])) {
            $this->setMaxColumns($data['maxColumns']);
        }

        if (isset($data['maxContentSizeCategory'])) {
            $this->setMaxContentSizeCategory($data['maxContentSizeCategory']);
        }

        if (isset($data['maxSpecVersion'])) {
            $this->setMaxSpecVersion($data['maxSpecVersion']);
        }

        if (isset($data['maxViewportAspectRatio'])) {
            $this->setMaxViewportAspectRatio($data['maxViewportAspectRatio']);
        }

        if (isset($data['maxViewportWidth'])) {
            $this->setMaxViewportWidth($data['maxViewportWidth']);
        }

        if (isset($data['minColumns'])) {
            $this->setMinColumns($data['minColumns']);
        }

        if (isset($data['minContentSizeCategory'])) {
            $this->setMinContentSizeCategory($data['minContentSizeCategory']);
        }

        if (isset($data['minSpecVersion'])) {
            $this->setMinSpecVersion($data['minSpecVersion']);
        }

        if (isset($data['minViewportAspectRatio'])) {
            $this->setMinViewportAspectRatio($data['minViewportAspectRatio']);
        }

        if (isset($data['minViewportWidth'])) {
            $this->setMinViewportWidth($data['minViewportWidth']);
        }

        if (isset($data['platform'])) {
            $this->setPlatform($data['platform']);
        }

        if (isset($data['subscriptionStatus'])) {
            $this->setSubscriptionStatus($data['subscriptionStatus']);
        }

        if (isset($data['verticalSizeClass'])) {
            $this->setVerticalSizeClass($data['verticalSizeClass']);
        }

        if (isset($data['viewLocation'])) {
            $this->setViewLocation($data['viewLocation']);
        }
    }

    /**
     * Get the horizontalSizeClass
     * @return string
     */
    public function getHorizontalSizeClass()
    {
        return $this->horizontalSizeClass;
    }

    /**
     * Set the horizontalSizeClass
     * @param string $horizontalSizeClass
     * @return $this
     */
    public function setHorizontalSizeClass($horizontalSizeClass)
    {
        if (is_null($horizontalSizeClass)) {
            $this->horizontalSizeClass = null;
            return $this;
        }

        Assert::oneOf($horizontalSizeClass, ["any", "regular", "compact"]);

        $this->horizontalSizeClass = $horizontalSizeClass;
        return $this;
    }

    /**
     * Get the maxColumns
     * @return integer
     */
    public function getMaxColumns()
    {
        return $this->maxColumns;
    }

    /**
     * Set the maxColumns
     * @param integer $maxColumns
     * @return $this
     */
    public function setMaxColumns($maxColumns)
    {
        if (is_null($maxColumns)) {
            $this->maxColumns = null;
            return $this;
        }

        Assert::integer($maxColumns);

        $this->maxColumns = $maxColumns;
        return $this;
    }

    /**
     * Get the maxContentSizeCategory
     * @return string
     */
    public function getMaxContentSizeCategory()
    {
        return $this->maxContentSizeCategory;
    }

    /**
     * Set the maxContentSizeCategory
     * @param string $maxContentSizeCategory
     * @return $this
     */
    public function setMaxContentSizeCategory($maxContentSizeCategory)
    {
        if (is_null($maxContentSizeCategory)) {
            $this->maxContentSizeCategory = null;
            return $this;
        }

        Assert::oneOf($maxContentSizeCategory, [
            "XS",
            "S",
            "M",
            "L",
            "XL",
            "XXL",
            "XXXL",
            "AX-M",
            "AX-L",
            "AX-XL",
            "AX-XXL",
            "AX-XXXL"
        ]);

        $this->maxContentSizeCategory = $maxContentSizeCategory;
        return $this;
    }

    /**
     * Get the maxSpecVersion
     * @return string
     */
    public function getMaxSpecVersion()
    {
        return $this->maxSpecVersion;
    }

    /**
     * Set the maxSpecVersion
     * @param string $maxSpecVersion
     * @return $this
     */
    public function setMaxSpecVersion($maxSpecVersion)
    {
        if (is_null($maxSpecVersion)) {
            $this->maxSpecVersion = null;
            return $this;
        }

        Assert::string($maxSpecVersion);

        $this->maxSpecVersion = $maxSpecVersion;
        return $this;
    }

    /**
     * Get the maxViewportAspectRatio
     * @return float
     */
    public function getMaxViewportAspectRatio()
    {
        return $this->maxViewportAspectRatio;
    }

    /**
     * Set the maxViewportAspectRatio
     * @param float $maxViewportAspectRatio
     * @return $this
     */
    public function setMaxViewportAspectRatio($maxViewportAspectRatio)
    {
        if (is_null($maxViewportAspectRatio)) {
            $this->maxViewportAspectRatio = null;
            return $this;
        }

        Assert::float($maxViewportAspectRatio);

        $this->maxViewportAspectRatio = $maxViewportAspectRatio;
        return $this;
    }

    /**
     * Get the maxViewportWidth
     * @return integer
     */
    public function getMaxViewportWidth()
    {
        return $this->maxViewportWidth;
    }

    /**
     * Set the maxViewportWidth
     * @param integer $maxViewportWidth
     * @return $this
     */
    public function setMaxViewportWidth($maxViewportWidth)
    {
        if (is_null($maxViewportWidth)) {
            $this->maxViewportWidth = null;
            return $this;
        }

        Assert::integer($maxViewportWidth);

        $this->maxViewportWidth = $maxViewportWidth;
        return $this;
    }

    /**
     * Get the minColumns
     * @return integer
     */
    public function getMinColumns()
    {
        return $this->minColumns;
    }

    /**
     * Set the minColumns
     * @param integer $minColumns
     * @return $this
     */
    public function setMinColumns($minColumns)
    {
        if (is_null($minColumns)) {
            $this->minColumns = null;
            return $this;
        }

        Assert::integer($minColumns);

        $this->minColumns = $minColumns;
        return $this;
    }

    /**
     * Get the minContentSizeCategory
     * @return string
     */
    public function getMinContentSizeCategory()
    {
        return $this->minContentSizeCategory;
    }

    /**
     * Set the minContentSizeCategory
     * @param string $minContentSizeCategory
     * @return $this
     */
    public function setMinContentSizeCategory($minContentSizeCategory)
    {
        if (is_null($minContentSizeCategory)) {
            $this->minContentSizeCategory = null;
            return $this;
        }

        Assert::oneOf($minContentSizeCategory, [
            "XS",
            "S",
            "M",
            "L",
            "XL",
            "XXL",
            "XXXL",
            "AX-M",
            "AX-L",
            "AX-XL",
            "AX-XXL",
            "AX-XXXL"
        ]);

        $this->minContentSizeCategory = $minContentSizeCategory;
        return $this;
    }

    /**
     * Get the minSpecVersion
     * @return string
     */
    public function getMinSpecVersion()
    {
        return $this->minSpecVersion;
    }

    /**
     * Set the minSpecVersion
     * @param string $minSpecVersion
     * @return $this
     */
    public function setMinSpecVersion($minSpecVersion)
    {
        if (is_null($minSpecVersion)) {
            $this->minSpecVersion = null;
            return $this;
        }

        Assert::string($minSpecVersion);

        $this->minSpecVersion = $minSpecVersion;
        return $this;
    }

    /**
     * Get the minViewportAspectRatio
     * @return float
     */
    public function getMinViewportAspectRatio()
    {
        return $this->minViewportAspectRatio;
    }

    /**
     * Set the minViewportAspectRatio
     * @param float $minViewportAspectRatio
     * @return $this
     */
    public function setMinViewportAspectRatio($minViewportAspectRatio)
    {
        if (is_null($minViewportAspectRatio)) {
            $this->minViewportAspectRatio = null;
            return $this;
        }

        Assert::float($minViewportAspectRatio);

        $this->minViewportAspectRatio = $minViewportAspectRatio;
        return $this;
    }

    /**
     * Get the minViewportWidth
     * @return integer
     */
    public function getMinViewportWidth()
    {
        return $this->minViewportWidth;
    }

    /**
     * Set the minViewportWidth
     * @param integer $minViewportWidth
     * @return $this
     */
    public function setMinViewportWidth($minViewportWidth)
    {
        if (is_null($minViewportWidth)) {
            $this->minViewportWidth = null;
            return $this;
        }

        Assert::integer($minViewportWidth);

        $this->minViewportWidth = $minViewportWidth;
        return $this;
    }

    /**
     * Get the platform
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set the platform
     * @param string $platform
     * @return $this
     */
    public function setPlatform($platform)
    {
        if (is_null($platform)) {
            $this->platform = null;
            return $this;
        }

        Assert::oneOf($platform, ["any", "ios", "macos"]);

        $this->platform = $platform;
        return $this;
    }

    /**
     * Get the subscriptionStatus
     * @return string
     */
    public function getSubscriptionStatus()
    {
        return $this->subscriptionStatus;
    }

    /**
     * Set the subscriptionStatus
     * @param string $subscriptionStatus
     * @return $this
     */
    public function setSubscriptionStatus($subscriptionStatus)
    {
        if (is_null($subscriptionStatus)) {
            $this->subscriptionStatus = null;
            return $this;
        }

        Assert::oneOf($subscriptionStatus, ["bundle", "subscribed"]);

        $this->subscriptionStatus = $subscriptionStatus;
        return $this;
    }

    /**
     * Get the verticalSizeClass
     * @return string
     */
    public function getVerticalSizeClass()
    {
        return $this->verticalSizeClass;
    }

    /**
     * Set the verticalSizeClass
     * @param string $verticalSizeClass
     * @return $this
     */
    public function setVerticalSizeClass($verticalSizeClass)
    {
        if (is_null($verticalSizeClass)) {
            $this->verticalSizeClass = null;
            return $this;
        }

        Assert::oneOf($verticalSizeClass, ["any", "regular", "compact"]);

        $this->verticalSizeClass = $verticalSizeClass;
        return $this;
    }

    /**
     * Get the viewLocation
     * @return string
     */
    public function getViewLocation()
    {
        return $this->viewLocation;
    }

    /**
     * Set the viewLocation
     * @param string $viewLocation
     * @return $this
     */
    public function setViewLocation($viewLocation)
    {
        if (is_null($viewLocation)) {
            $this->viewLocation = null;
            return $this;
        }

        Assert::oneOf($viewLocation, [
            "any",
            "article",
            "issue_table_of_contents",
            "issue"
        ]);

        $this->viewLocation = $viewLocation;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->horizontalSizeClass)) {
            $data['horizontalSizeClass'] = $this->horizontalSizeClass;
        }
        if (isset($this->maxColumns)) {
            $data['maxColumns'] = $this->maxColumns;
        }
        if (isset($this->maxContentSizeCategory)) {
            $data['maxContentSizeCategory'] = $this->maxContentSizeCategory;
        }
        if (isset($this->maxSpecVersion)) {
            $data['maxSpecVersion'] = $this->maxSpecVersion;
        }
        if (isset($this->maxViewportAspectRatio)) {
            $data['maxViewportAspectRatio'] = $this->maxViewportAspectRatio;
        }
        if (isset($this->maxViewportWidth)) {
            $data['maxViewportWidth'] = $this->maxViewportWidth;
        }
        if (isset($this->minColumns)) {
            $data['minColumns'] = $this->minColumns;
        }
        if (isset($this->minContentSizeCategory)) {
            $data['minContentSizeCategory'] = $this->minContentSizeCategory;
        }
        if (isset($this->minSpecVersion)) {
            $data['minSpecVersion'] = $this->minSpecVersion;
        }
        if (isset($this->minViewportAspectRatio)) {
            $data['minViewportAspectRatio'] = $this->minViewportAspectRatio;
        }
        if (isset($this->minViewportWidth)) {
            $data['minViewportWidth'] = $this->minViewportWidth;
        }
        if (isset($this->platform)) {
            $data['platform'] = $this->platform;
        }
        if (isset($this->subscriptionStatus)) {
            $data['subscriptionStatus'] = $this->subscriptionStatus;
        }
        if (isset($this->verticalSizeClass)) {
            $data['verticalSizeClass'] = $this->verticalSizeClass;
        }
        if (isset($this->viewLocation)) {
            $data['viewLocation'] = $this->viewLocation;
        }
        return $data;
    }
}

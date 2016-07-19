<?php

namespace Charcoal\Ui\MenuItem;

use \InvalidArgumentException;

// Module `charcoal-translation` dependencies
use \Charcoal\Translation\TranslationString;

// Intra-module (`charcoal-ui`) dependencies
use \Charcoal\Ui\AbstractUiItem;
use \Charcoal\Ui\Menu\MenuInterface;
use \Charcoal\Ui\MenuItem\MenuItemInterface;

/**
 * Default implementation of the MenuInterface, as an abstract class.
 */
abstract class AbstractMenuItem extends AbstractUiItem implements MenuItemInterface
{
    /**
     * Parent menu item
     * @var MenuInterface $menu
     */
    private $menu;

    /**
     * @var string $ident
     */
    protected $ident;

    /**
     * @var TranslationString $label
     */
    protected $label;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var MenuItemInterface[] $children
     */
    protected $children;

    /**
     * @var callable $childCallback
     */
    private $childCallback = null;

     /**
      * @param array|ArrayAccess $data Class dependencies.
      */
    public function __construct($data)
    {
        $this->setMenu($data['menu']);
        $this->setMenuItemBuilder($data['menu_item_builder']);
    }

    /**
     * Set the parent (menu) object.
     *
     * @param MenuInterface $menu The parent menu object.
     * @return MenuItemInterface Chainable
     */
    protected function setMenu(MenuInterface $menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * @param MenuItemBuilder $menuItemBuilder The Menu Item Builder that will be used to create new items.
     * @return MenuItemInterface Chainable
     */
    public function setMenuItemBuilder(MenuItemBuilder $menuItemBuilder)
    {
        $this->menuItemBuilder = $menuItemBuilder;
        return $this;
    }

    /**
     * @param callable $cb The item callback.
     * @return MenuItemInterface Chainable
     */
    public function setItemCallback(callable $cb)
    {
        $this->childCallback = $cb;
        return $this;
    }

    /**
     * @param string $ident The menu item identifier.
     * @throws InvalidArgumentException If the identifier argument is not a string.
     * @return MenuItem Chainable
     */
    public function setIdent($ident)
    {
        if (!is_string($ident)) {
            throw new InvalidArgumentException(
                'Ident must a string'
            );
        }
        $this->ident = $ident;
        return $this;
    }

    /**
     * @return string
     */
    public function ident()
    {
        return $this->ident;
    }

    /**
     * @param mixed $label The menu item label.
     * @return MenuItem Chainable
     */
    public function setLabel($label)
    {
        $this->label = new TranslationString($label);
        return $this;
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * @param string $url The menu item URL.
     * @return MenuItem Chainable
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return boolean
     */
    public function hasUrl()
    {
        return !!($this->url());
    }

    /**
     * @param array $children The menu item children items structure.
     * @return MenuItem Chainable
     */
    public function setChildren(array $children)
    {
        $this->children = [];
        foreach ($children as $c) {
            $this->addChild($c);
        }
        return $this;
    }

    /**
     * @param array|MenuItem $child The child menu structure or object.
     * @throws InvalidArgumentException If the child is not a menu object or structure.
     * @return MenuItem Chainable
     */
    public function addChild($child)
    {
        if (is_array($child)) {
            $child['menu'] = $this->menu;
            $c = $this->menuItemBuilder->build($child);
            $this->children[] = $c;
        } elseif ($child instanceof MenuItemInterface) {
            $this->children[] = $child;
        } else {
            throw new InvalidArgumentException(
                'Child must be an array or a MenuItem object'
            );
        }
        return $this;
    }

    /**
     * Children (menu item) generator
     *
     * @param callable $childCallback Optional callback.
     * @return MenuItemInterface[]
     */
    public function children(callable $childCallback = null)
    {
        $children = $this->children;
        uasort($children, ['self', 'sortChildrenByPrioriy']);

        $childCallback = isset($childCallback) ? $childCallback : $this->childCallback;
        foreach ($children as $child) {
            if ($childCallback) {
                $childCallback($child);
            }
            $GLOBALS['widget_template'] = $item->template();
            yield $child->ident() => $child;
        }
    }

    /**
     * @return boolean
     */
    public function hasChildren()
    {
        return (count($this->children) > 0);
    }

    /**
     * @return integer
     */
    public function numChildren()
    {
        return count($this->children);
    }
}
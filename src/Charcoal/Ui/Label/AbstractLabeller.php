<?php

namespace Charcoal\Ui\Label;

use \InvalidArgumentException;

// From 'charcoa-config'
use \Charcoal\Config\AbstractConfig;

// From 'charcoal-core'
use \Charcoal\Model\DescribableInterface;

// From 'charcoa-translation'
use \Charcoal\Translation\TranslationString;

/**
 * A Basic Labeller
 *
 * Abstract implementation of {@see \Charcoal\Ui\Label\LabellerInterface}.
 */
abstract class AbstractLabeller extends AbstractConfig implements
    LabellerInterface
{
    /**
     * Create a new label collection from the given entity.
     *
     * @param  DescribableInterface $entity    A describable entity.
     * @param  ConfigInterface[]    $delegates An array of delegates (labels) to set.
     * @return self
     */
    public static function createFromDescribable(DescribableInterface $entity, array $delegates = null)
    {
        $metadata = $entity->metadata();

        if (isset($metadata['labels'])) {
            return new static($metadata['labels'], $delegates);
        } else {
            throw new InvalidArgumentException('Entity must define a "labels" structure.');
        }
    }

    /**
     * Assign the given value to the given key of the collection.
     *
     * @see   \Charcoal\Config\AbstractEntity::offsetSet()
     * @see   \ArrayAccess::offsetSet()
     *
     * @param  string $key   The key to assign $value to.
     * @param  mixed  $value Value to assign to $key.
     * @throws InvalidArgumentException If the key argument is not a string or is a "numeric" value.
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_numeric($key)) {
            throw new InvalidArgumentException(
                'Labeller only supports non-numeric keys.'
            );
        }

        if (!TranslationString::isTranslatable($value)) {
            throw new InvalidArgumentException(
                'Labeller only supports translatable values.'
            );
        }

        parent::offsetSet($key, new TranslationString($value));
    }
}

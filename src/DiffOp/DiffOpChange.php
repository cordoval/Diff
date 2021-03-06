<?php

namespace Diff\DiffOp;

/**
 * Represents a change.
 * This means the item is present in both the new and old objects, but changed value.
 *
 * @since 0.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DiffOpChange extends AtomicDiffOp {

	private $newValue;
	private $oldValue;

	/**
	 * @see DiffOp::getType
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	public function getType() {
		return 'change';
	}

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 *
	 * @param mixed $oldValue
	 * @param mixed $newValue
	 */
	public function __construct( $oldValue, $newValue ) {
		$this->oldValue = $oldValue;
		$this->newValue = $newValue;
	}

	/**
	 * @since 0.1
	 *
	 * @return mixed
	 */
	public function getOldValue() {
		return $this->oldValue;
	}

	/**
	 * @since 0.1
	 *
	 * @return mixed
	 */
	public function getNewValue() {
		return $this->newValue;
	}

	/**
	 * @see Serializable::serialize
	 *
	 * @since 0.1
	 *
	 * @return string|null
	 */
	public function serialize() {
		return serialize( array( $this->newValue, $this->oldValue ) );
	}

	/**
	 * @see Serializable::unserialize
	 *
	 * @since 0.1
	 *
	 * @param string $serialization
	 *
	 * @return DiffOpChange
	 */
	public function unserialize( $serialization ) {
		list( $this->newValue, $this->oldValue ) = unserialize( $serialization );
	}

	/**
	 * @see DiffOp::toArray
	 *
	 * @since 0.5
	 *
	 * @param callable|null $valueConverter optional callback used to convert any
	 *        complex values to arrays.
	 *
	 * @return array
	 */
	public function toArray( $valueConverter = null ) {
		return array(
			'type' => $this->getType(),
			'newvalue' => $this->objectToArray( $this->newValue, $valueConverter ),
			'oldvalue' => $this->objectToArray( $this->oldValue, $valueConverter ),
		);
	}

}
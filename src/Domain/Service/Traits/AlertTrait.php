<?php namespace Pete001\Alerter\Domain\Service\Traits;

/**
 * Various helper methods
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
trait AlertTrait
{
	/**
	 * Presentation layer to db transformation
	 *
	 * @param String $text The text to transform
	 *
	 * @return String
	 */
	public function textToDatastore($text) {
		return strtolower($text);
	}

	/**
	 * Traverse an array of objects to search for a property
	 * and return the value if found, otherwise throw exception
	 *
	 * @param String           $property     The property to search for
	 * @param Array            $requirements Array of requirements
	 *
	 * @throws Error_Exception               If the property doesnt exist
	 *
	 * @return String                        The corresponding value
	 */
	public function required($field, $requirements) {
		foreach ($requirements as $object) {
			if ($field === $object->title) {
				return $object;
			}
		}
	}
}

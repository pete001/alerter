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
	 * @param Array            $details      Array of alert details
	 *
	 * @throws Error_Exception               If the property doesnt exist
	 *
	 * @return String                        The corresponding value
	 */
	public function required($property, $details) {
		foreach ($details as $object) {
			$requirements = $object->getAlertRequirement();
			if (property_exists($requirements, 'title') && $property === $requirements->title) {
				return $object->value;
			}
		}

		throw new \Error_Exception("Required alert property $property not set");
	}
}

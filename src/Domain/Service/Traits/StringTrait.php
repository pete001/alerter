<?php namespace Pete001\Alerter\Domain\Service\Traits;

/**
 * String manipulation
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
trait StringTrait
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
}

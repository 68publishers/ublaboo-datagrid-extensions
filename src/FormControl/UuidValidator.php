<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\FormControl;

use Nette;
use Ramsey;

final class UuidValidator
{
	use Nette\StaticClass;

	const   UUID = __CLASS__ . '::validateUuid',
			UUID_HEX = __CLASS__ . '::validateHexUuid';

	/**
	 * @param \Nette\Forms\Controls\BaseControl $control
	 *
	 * @return bool
	 */
	public static function validateUuid(Nette\Forms\Controls\BaseControl $control): bool
	{
		return Ramsey\Uuid\Uuid::isValid((string) $control->getValue());
	}

	/**
	 * @param \Nette\Forms\Controls\BaseControl $control
	 *
	 * @return bool
	 */
	public function validateHexUuid(Nette\Forms\Controls\BaseControl $control): bool
	{
		return (bool) Nette\Utils\Strings::match(
			$control->getValue(),
			'/^(?:[0-9A-Fa-f]{8}[0-9A-Fa-f]{4}[1-5][0-9A-Fa-f]{3}[89AaBb][0-9A-Fa-f]{3}[0-9A-Fa-f]{12}|00000000000000000000000000000000)$/'
		);
	}
}

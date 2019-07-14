<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\FormControl;

use Nette;
use Ramsey;

final class Uuid extends Nette\Forms\Controls\TextInput
{
	/** @var bool  */
	private $silent = FALSE;

	/** @var bool  */
	private $isHex = FALSE;

	/**
	 * @param NULL|string|\Nette\Utils\Html $label
	 */
	public function __construct($label = NULL)
	{
		parent::__construct($label, NULL);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getValue()
	{
		$value = parent::getValue();

		try {
			if (is_string($value)) {
				$value = Ramsey\Uuid\Uuid::fromString($value);
			} elseif (NULL !== $value && !$value instanceof Ramsey\Uuid\UuidInterface) {
				throw new Ramsey\Uuid\Exception\InvalidUuidStringException;
			}
		} catch (Ramsey\Uuid\Exception\InvalidUuidStringException $e) {
			if (FALSE === $this->silent) {
				throw $e;
			}

			$value = NULL;
		}

		return $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getControl(): Nette\Utils\Html
	{
		$control = parent::getControl();
		$value = $this->getValue();

		if ($value instanceof Ramsey\Uuid\UuidInterface) {
			$control->setAttribute('value', TRUE === $this->isHex ? $value->getHex() : $value->toString());
		}

		return $control;
	}

	/**
	 * @param bool $silent
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\FormControl\Uuid
	 */
	public function setSilentMode(bool $silent): self
	{
		$this->silent = $silent;

		return $this;
	}

	/**
	 * @param string|\Nette\Utils\Html $message
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\FormControl\Uuid
	 */
	public function addUuidRule($message): self
	{
		$this->addRule(UuidValidator::UUID, $message);

		return $this;
	}

	/**
	 * @param string|\Nette\Utils\Html $message
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\FormControl\Uuid
	 */
	public function addUuidHexRule($message): self
	{
		$this->addRule(UuidValidator::UUID_HEX, $message);
		$this->isHex = TRUE;

		return $this;
	}
}

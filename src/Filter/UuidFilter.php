<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Filter;

use Nette;
use Ublaboo;
use SixtyEightPublishers;

final class UuidFilter extends Ublaboo\DataGrid\Filter\FilterText
{
	/** @var string  */
	private $message = 'ublaboo_datagrid.invalid_uuid';

	/** @var bool  */
	private $hex = FALSE;

	/**
	 * Adds text field to filter form
	 * @param Nette\Forms\Container $container
	 */
	public function addToFormContainer(Nette\Forms\Container $container): void
	{
		$container[$this->key] = ($uuid = new SixtyEightPublishers\UblabooDataGridExtensions\FormControl\Uuid($this->name))
			->setRequired(FALSE)
			->setSilentMode(TRUE);

		if (TRUE === $this->hex) {
			$uuid->addUuidHexRule($this->message);
		} else {
			$uuid->addUuidRule($this->message);
		}

		$this->addAttributes($uuid);

		if ($this->getPlaceholder()) {
			$uuid->setAttribute('placeholder', $this->getPlaceholder());
		}
	}

	/**
	 * @param bool $hex
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\UuidFilter
	 */
	public function setHex(bool $hex): self
	{
		$this->hex = $hex;

		return $this;
	}

	/**
	 * @param string $message
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\UuidFilter
	 */
	public function setValidatorMessage(string $message): self
	{
		$this->message = $message;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isExactSearch(): bool
	{
		return TRUE;
	}


	/**
	 * {@inheritdoc}
	 */
	public function setExactSearch($exact = TRUE): void
	{
		throw new \BadMethodCallException(sprintf(
			'Calling of method %s is not allowed',
			__METHOD__
		));
	}


	/**
	 * {@inheritdoc}
	 */
	public function setSplitWordsSearch($split_words_search): void
	{
		throw new \BadMethodCallException(sprintf(
			'Calling of method %s is not allowed',
			__METHOD__
		));
	}


	/**
	 * {@inheritdoc}
	 */
	public function hasSplitWordsSearch(): bool
	{
		return FALSE;
	}
}

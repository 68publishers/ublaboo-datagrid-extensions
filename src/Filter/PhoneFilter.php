<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Filter;

use IPub;
use Nette;
use Ublaboo;

final class PhoneFilter extends Ublaboo\DataGrid\Filter\FilterText
{
	/** @var array  */
	private $countries = [];

	/** @var string  */
	private $message = 'ublaboo_datagrid.invalid_phone';

	/**
	 * {@inheritdoc}
	 */
	public function addToFormContainer(Nette\Forms\Container $container): void
	{
		/** @var \IPub\FormPhone\Controls\Phone $phone */
		/** @noinspection PhpUndefinedMethodInspection */
		$phone = $container->addPhone($this->key, $this->name)
			->setRequired(FALSE)
			->setAllowedCountries($this->countries);

		$phone->addRule(IPub\FormPhone\Forms\PhoneValidator::PHONE, $this->message);

		$this->addAttributes($phone);
	}

	/**
	 * @param string[] $countries
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\PhoneFilter
	 */
	public function setCountries(array $countries): self
	{
		$this->countries = $countries;

		return $this;
	}

	/**
	 * @param string $message
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\PhoneFilter
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

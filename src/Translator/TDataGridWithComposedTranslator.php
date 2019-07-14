<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Translator;

use Nette;

trait TDataGridWithComposedTranslator
{
	/**
	 * {@inheritdoc}
	 */
	public function setTranslator(Nette\Localization\ITranslator $translator)
	{
		/** @noinspection PhpUndefinedClassInspection */
		return parent::setTranslator(new ComposedTranslator($translator));
	}
}

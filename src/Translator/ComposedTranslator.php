<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Translator;

use Nette;

final class ComposedTranslator implements Nette\Localization\ITranslator
{
	use Nette\SmartObject;

	/** @var \Nette\Localization\ITranslator  */
	private $translator;

	/**
	 * @param \Nette\Localization\ITranslator $translator
	 */
	public function __construct(Nette\Localization\ITranslator $translator)
	{
		$this->translator = $translator;
	}

	/**
	 * @param string $message
	 *
	 * @return bool
	 */
	private function isDataGridMessage(string $message): bool
	{
		return Nette\Utils\Strings::startsWith($message, 'ublaboo_datagrid');
	}

	/************* interface \Nette\Localization\ITranslator *************/

	/**
	 * {@inheritdoc}
	 */
	public function translate($message, $count = null)
	{
		$args = func_get_args();
		$message = count($args) ? array_shift($args) : NULL;

		# kdyby's phrase
		$phraseClass = 'Kdyby\Translation\Phrase';
		if ($message instanceof $phraseClass && $this->isDataGridMessage($message->message)) {
			$message->message = '//' . $message->message;
		} elseif (is_string($message) && $this->isDataGridMessage($message)) {
			$message = '//' . $message;
		}

		return $this->translator->translate(... array_merge([$message], $args));
	}
}

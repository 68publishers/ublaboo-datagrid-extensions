<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions;

use Ublaboo;
use SixtyEightPublishers;

class DataGrid extends Ublaboo\DataGrid\DataGrid
{
	use Filter\TDataGridWithUuidFilter;
	use Filter\TDataGridWithPhoneFilter;
	use Translator\TDataGridWithComposedTranslator;
}

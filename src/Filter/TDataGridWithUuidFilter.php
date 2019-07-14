<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Filter;

use Ublaboo;

/**
 * @property \Ublaboo\DataGrid\Filter\Filter[] $filters
 * @method bool addFilterCheck($key)
 */
trait TDataGridWithUuidFilter
{
	/**
	 * @param string      $key
	 * @param string      $name
	 * @param string|NULL $columns
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\UuidFilter
	 * @throws \Ublaboo\DataGrid\Exception\DataGridException
	 */
	public function addFilterUuid(string $key, string $name, ?string $columns = NULL): UuidFilter
	{
		$columns = NULL === $columns ? [$key] : (is_string($columns) ? [$columns] : $columns);

		if (!is_array($columns)) {
			throw new Ublaboo\DataGrid\Exception\DataGridException('Filter Text can accept only array or string.');
		}

		$this->addFilterCheck($key);

		/** @noinspection PhpParamsInspection */
		return $this->filters[$key] = new UuidFilter($this, $key, $name, $columns);
	}
}

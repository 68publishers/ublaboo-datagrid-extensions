<?php

declare(strict_types=1);

namespace SixtyEightPublishers\UblabooDataGridExtensions\Filter;

use Ublaboo;

/**
 * @property \Ublaboo\DataGrid\Filter\Filter[] $filters
 * @method bool addFilterCheck($key)
 */
trait TDataGridWithPhoneFilter
{
	/**
	 * @param string      $key
	 * @param string      $name
	 * @param array       $countries
	 * @param string|NULL $columns
	 *
	 * @return \SixtyEightPublishers\UblabooDataGridExtensions\Filter\PhoneFilter
	 * @throws \Ublaboo\DataGrid\Exception\DataGridException
	 */
	public function addFilterPhone(string $key, string $name, array $countries, ?string $columns = NULL): PhoneFilter
	{
		$columns = NULL === $columns ? [$key] : (is_string($columns) ? [$columns] : $columns);

		if (!is_array($columns)) {
			throw new Ublaboo\DataGrid\Exception\DataGridException('Filter Text can accept only array or string.');
		}

		$this->addFilterCheck($key);

		/** @noinspection PhpParamsInspection */
		$filter = $this->filters[$key] = new PhoneFilter($this, $key, $name, $columns);

		$filter->setCountries($countries);

		return $filter;
	}
}

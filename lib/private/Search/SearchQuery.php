<?php

declare(strict_types=1);

/**
 * @copyright 2020 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 * @author Joas Schilling <coding@schilljs.com>
 * @author John Molakvoæ <skjnldsv@protonmail.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OC\Search;

use OCP\Search\ISearchQuery;

class SearchQuery implements ISearchQuery {
	public const LIMIT_DEFAULT = 5;

	/**
	 * @param string[] $filters
	 * @param string[] $routeParameters
	 */
	public function __construct(
		private array $filters,
		private int $sortOrder = ISearchQuery::SORT_DATE_DESC,
		private int $limit = self::LIMIT_DEFAULT,
		private int|string|null $cursor = null,
		private string $route = '',
		private	array $routeParameters = [],
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getTerm(): string {
		return $this->getFilter('term', '');
	}

	/**
	 * @inheritDoc
	 */
	public function getFilter(string $name, $default = null) {
		return array_key_exists($name, $this->filters) ? $this->filters[$name] : $default;
	}

	/**
	 * @inheritDoc
	 */
	public function getFilters(): array {
		return $this->filters;
	}

	/**
	 * @inheritDoc
	 */
	public function getSortOrder(): int {
		return $this->sortOrder;
	}

	/**
	 * @inheritDoc
	 */
	public function getLimit(): int {
		return $this->limit;
	}

	/**
	 * @inheritDoc
	 */
	public function getCursor(): int|string|null {
		return $this->cursor;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoute(): string {
		return $this->route;
	}

	/**
	 * @inheritDoc
	 */
	public function getRouteParameters(): array {
		return $this->routeParameters;
	}
}

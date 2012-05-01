<?php


/**
 * Base class that represents a query for the 'performance' table.
 *
 * 
 *
 * @method     PerformanceQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     PerformanceQuery orderByshowId($order = Criteria::ASC) Order by the showId column
 * @method     PerformanceQuery orderByvenueId($order = Criteria::ASC) Order by the venueId column
 * @method     PerformanceQuery orderByname($order = Criteria::ASC) Order by the name column
 *
 * @method     PerformanceQuery groupByid() Group by the id column
 * @method     PerformanceQuery groupByshowId() Group by the showId column
 * @method     PerformanceQuery groupByvenueId() Group by the venueId column
 * @method     PerformanceQuery groupByname() Group by the name column
 *
 * @method     PerformanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PerformanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PerformanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PerformanceQuery leftJoinShow($relationAlias = null) Adds a LEFT JOIN clause to the query using the Show relation
 * @method     PerformanceQuery rightJoinShow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Show relation
 * @method     PerformanceQuery innerJoinShow($relationAlias = null) Adds a INNER JOIN clause to the query using the Show relation
 *
 * @method     PerformanceQuery leftJoinVenue($relationAlias = null) Adds a LEFT JOIN clause to the query using the Venue relation
 * @method     PerformanceQuery rightJoinVenue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Venue relation
 * @method     PerformanceQuery innerJoinVenue($relationAlias = null) Adds a INNER JOIN clause to the query using the Venue relation
 *
 * @method     PerformanceQuery leftJoinPerformanceToTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PerformanceToTicketType relation
 * @method     PerformanceQuery rightJoinPerformanceToTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PerformanceToTicketType relation
 * @method     PerformanceQuery innerJoinPerformanceToTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the PerformanceToTicketType relation
 *
 * @method     PerformanceQuery leftJoinPerformanceToAvailability($relationAlias = null) Adds a LEFT JOIN clause to the query using the PerformanceToAvailability relation
 * @method     PerformanceQuery rightJoinPerformanceToAvailability($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PerformanceToAvailability relation
 * @method     PerformanceQuery innerJoinPerformanceToAvailability($relationAlias = null) Adds a INNER JOIN clause to the query using the PerformanceToAvailability relation
 *
 * @method     PerformanceQuery leftJoinPerformanceToOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PerformanceToOrder relation
 * @method     PerformanceQuery rightJoinPerformanceToOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PerformanceToOrder relation
 * @method     PerformanceQuery innerJoinPerformanceToOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PerformanceToOrder relation
 *
 * @method     Performance findOne(PropelPDO $con = null) Return the first Performance matching the query
 * @method     Performance findOneOrCreate(PropelPDO $con = null) Return the first Performance matching the query, or a new Performance object populated from the query conditions when no match is found
 *
 * @method     Performance findOneByid(int $id) Return the first Performance filtered by the id column
 * @method     Performance findOneByshowId(int $showId) Return the first Performance filtered by the showId column
 * @method     Performance findOneByvenueId(int $venueId) Return the first Performance filtered by the venueId column
 * @method     Performance findOneByname(string $name) Return the first Performance filtered by the name column
 *
 * @method     array findByid(int $id) Return Performance objects filtered by the id column
 * @method     array findByshowId(int $showId) Return Performance objects filtered by the showId column
 * @method     array findByvenueId(int $venueId) Return Performance objects filtered by the venueId column
 * @method     array findByname(string $name) Return Performance objects filtered by the name column
 *
 * @package    propel.generator.simply.om
 */
abstract class BasePerformanceQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePerformanceQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Performance', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PerformanceQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PerformanceQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PerformanceQuery) {
			return $criteria;
		}
		$query = new PerformanceQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Performance|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PerformancePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PerformancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Performance A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `SHOWID`, `VENUEID`, `NAME` FROM `performance` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Performance();
			$obj->hydrate($row);
			PerformancePeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Performance|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PerformancePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PerformancePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByid(1234); // WHERE id = 1234
	 * $query->filterByid(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterByid(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PerformancePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the showId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByshowId(1234); // WHERE showId = 1234
	 * $query->filterByshowId(array(12, 34)); // WHERE showId IN (12, 34)
	 * $query->filterByshowId(array('min' => 12)); // WHERE showId > 12
	 * </code>
	 *
	 * @see       filterByShow()
	 *
	 * @param     mixed $showId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByshowId($showId = null, $comparison = null)
	{
		if (is_array($showId)) {
			$useMinMax = false;
			if (isset($showId['min'])) {
				$this->addUsingAlias(PerformancePeer::SHOWID, $showId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($showId['max'])) {
				$this->addUsingAlias(PerformancePeer::SHOWID, $showId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PerformancePeer::SHOWID, $showId, $comparison);
	}

	/**
	 * Filter the query on the venueId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByvenueId(1234); // WHERE venueId = 1234
	 * $query->filterByvenueId(array(12, 34)); // WHERE venueId IN (12, 34)
	 * $query->filterByvenueId(array('min' => 12)); // WHERE venueId > 12
	 * </code>
	 *
	 * @see       filterByVenue()
	 *
	 * @param     mixed $venueId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByvenueId($venueId = null, $comparison = null)
	{
		if (is_array($venueId)) {
			$useMinMax = false;
			if (isset($venueId['min'])) {
				$this->addUsingAlias(PerformancePeer::VENUEID, $venueId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($venueId['max'])) {
				$this->addUsingAlias(PerformancePeer::VENUEID, $venueId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PerformancePeer::VENUEID, $venueId, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByname('2011-03-14'); // WHERE name = '2011-03-14'
	 * $query->filterByname('now'); // WHERE name = '2011-03-14'
	 * $query->filterByname(array('max' => 'yesterday')); // WHERE name > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $name The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByname($name = null, $comparison = null)
	{
		if (is_array($name)) {
			$useMinMax = false;
			if (isset($name['min'])) {
				$this->addUsingAlias(PerformancePeer::NAME, $name['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($name['max'])) {
				$this->addUsingAlias(PerformancePeer::NAME, $name['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PerformancePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query by a related Show object
	 *
	 * @param     Show|PropelCollection $show The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByShow($show, $comparison = null)
	{
		if ($show instanceof Show) {
			return $this
				->addUsingAlias(PerformancePeer::SHOWID, $show->getid(), $comparison);
		} elseif ($show instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PerformancePeer::SHOWID, $show->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByShow() only accepts arguments of type Show or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Show relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function joinShow($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Show');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Show');
		}

		return $this;
	}

	/**
	 * Use the Show relation Show object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShowQuery A secondary query class using the current class as primary query
	 */
	public function useShowQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinShow($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Show', 'ShowQuery');
	}

	/**
	 * Filter the query by a related Venue object
	 *
	 * @param     Venue|PropelCollection $venue The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByVenue($venue, $comparison = null)
	{
		if ($venue instanceof Venue) {
			return $this
				->addUsingAlias(PerformancePeer::VENUEID, $venue->getid(), $comparison);
		} elseif ($venue instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PerformancePeer::VENUEID, $venue->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByVenue() only accepts arguments of type Venue or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Venue relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function joinVenue($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Venue');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Venue');
		}

		return $this;
	}

	/**
	 * Use the Venue relation Venue object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VenueQuery A secondary query class using the current class as primary query
	 */
	public function useVenueQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVenue($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Venue', 'VenueQuery');
	}

	/**
	 * Filter the query by a related TicketType object
	 *
	 * @param     TicketType $ticketType  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPerformanceToTicketType($ticketType, $comparison = null)
	{
		if ($ticketType instanceof TicketType) {
			return $this
				->addUsingAlias(PerformancePeer::ID, $ticketType->getperformanceId(), $comparison);
		} elseif ($ticketType instanceof PropelCollection) {
			return $this
				->usePerformanceToTicketTypeQuery()
				->filterByPrimaryKeys($ticketType->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPerformanceToTicketType() only accepts arguments of type TicketType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PerformanceToTicketType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function joinPerformanceToTicketType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PerformanceToTicketType');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PerformanceToTicketType');
		}

		return $this;
	}

	/**
	 * Use the PerformanceToTicketType relation TicketType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TicketTypeQuery A secondary query class using the current class as primary query
	 */
	public function usePerformanceToTicketTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPerformanceToTicketType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PerformanceToTicketType', 'TicketTypeQuery');
	}

	/**
	 * Filter the query by a related SeatAvailability object
	 *
	 * @param     SeatAvailability $seatAvailability  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPerformanceToAvailability($seatAvailability, $comparison = null)
	{
		if ($seatAvailability instanceof SeatAvailability) {
			return $this
				->addUsingAlias(PerformancePeer::ID, $seatAvailability->getperformanceId(), $comparison);
		} elseif ($seatAvailability instanceof PropelCollection) {
			return $this
				->usePerformanceToAvailabilityQuery()
				->filterByPrimaryKeys($seatAvailability->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPerformanceToAvailability() only accepts arguments of type SeatAvailability or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PerformanceToAvailability relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function joinPerformanceToAvailability($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PerformanceToAvailability');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PerformanceToAvailability');
		}

		return $this;
	}

	/**
	 * Use the PerformanceToAvailability relation SeatAvailability object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatAvailabilityQuery A secondary query class using the current class as primary query
	 */
	public function usePerformanceToAvailabilityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPerformanceToAvailability($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PerformanceToAvailability', 'SeatAvailabilityQuery');
	}

	/**
	 * Filter the query by a related Order object
	 *
	 * @param     Order $order  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPerformanceToOrder($order, $comparison = null)
	{
		if ($order instanceof Order) {
			return $this
				->addUsingAlias(PerformancePeer::ID, $order->getPerformanceid(), $comparison);
		} elseif ($order instanceof PropelCollection) {
			return $this
				->usePerformanceToOrderQuery()
				->filterByPrimaryKeys($order->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPerformanceToOrder() only accepts arguments of type Order or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PerformanceToOrder relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function joinPerformanceToOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PerformanceToOrder');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PerformanceToOrder');
		}

		return $this;
	}

	/**
	 * Use the PerformanceToOrder relation Order object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderQuery A secondary query class using the current class as primary query
	 */
	public function usePerformanceToOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPerformanceToOrder($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PerformanceToOrder', 'OrderQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Performance $performance Object to remove from the list of results
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function prune($performance = null)
	{
		if ($performance) {
			$this->addUsingAlias(PerformancePeer::ID, $performance->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePerformanceQuery
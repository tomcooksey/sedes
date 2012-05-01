<?php


/**
 * Base class that represents a query for the 'row' table.
 *
 * 
 *
 * @method     RowQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     RowQuery orderByvenueId($order = Criteria::ASC) Order by the venueId column
 * @method     RowQuery orderByname($order = Criteria::ASC) Order by the name column
 *
 * @method     RowQuery groupByid() Group by the id column
 * @method     RowQuery groupByvenueId() Group by the venueId column
 * @method     RowQuery groupByname() Group by the name column
 *
 * @method     RowQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RowQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RowQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RowQuery leftJoinVenue($relationAlias = null) Adds a LEFT JOIN clause to the query using the Venue relation
 * @method     RowQuery rightJoinVenue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Venue relation
 * @method     RowQuery innerJoinVenue($relationAlias = null) Adds a INNER JOIN clause to the query using the Venue relation
 *
 * @method     RowQuery leftJoinRowToSeat($relationAlias = null) Adds a LEFT JOIN clause to the query using the RowToSeat relation
 * @method     RowQuery rightJoinRowToSeat($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RowToSeat relation
 * @method     RowQuery innerJoinRowToSeat($relationAlias = null) Adds a INNER JOIN clause to the query using the RowToSeat relation
 *
 * @method     Row findOne(PropelPDO $con = null) Return the first Row matching the query
 * @method     Row findOneOrCreate(PropelPDO $con = null) Return the first Row matching the query, or a new Row object populated from the query conditions when no match is found
 *
 * @method     Row findOneByid(int $id) Return the first Row filtered by the id column
 * @method     Row findOneByvenueId(int $venueId) Return the first Row filtered by the venueId column
 * @method     Row findOneByname(string $name) Return the first Row filtered by the name column
 *
 * @method     array findByid(int $id) Return Row objects filtered by the id column
 * @method     array findByvenueId(int $venueId) Return Row objects filtered by the venueId column
 * @method     array findByname(string $name) Return Row objects filtered by the name column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseRowQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseRowQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Row', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RowQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RowQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RowQuery) {
			return $criteria;
		}
		$query = new RowQuery();
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
	 * @return    Row|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = RowPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(RowPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Row A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `VENUEID`, `NAME` FROM `row` WHERE `ID` = :p0';
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
			$obj = new Row();
			$obj->hydrate($row);
			RowPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Row|array|mixed the result, formatted by the current formatter
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
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RowPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RowPeer::ID, $keys, Criteria::IN);
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
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RowPeer::ID, $id, $comparison);
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
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByvenueId($venueId = null, $comparison = null)
	{
		if (is_array($venueId)) {
			$useMinMax = false;
			if (isset($venueId['min'])) {
				$this->addUsingAlias(RowPeer::VENUEID, $venueId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($venueId['max'])) {
				$this->addUsingAlias(RowPeer::VENUEID, $venueId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RowPeer::VENUEID, $venueId, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByname('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByname('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByname($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RowPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query by a related Venue object
	 *
	 * @param     Venue|PropelCollection $venue The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByVenue($venue, $comparison = null)
	{
		if ($venue instanceof Venue) {
			return $this
				->addUsingAlias(RowPeer::VENUEID, $venue->getid(), $comparison);
		} elseif ($venue instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RowPeer::VENUEID, $venue->toKeyValue('PrimaryKey', 'id'), $comparison);
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
	 * @return    RowQuery The current query, for fluid interface
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
	 * Filter the query by a related Seat object
	 *
	 * @param     Seat $seat  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function filterByRowToSeat($seat, $comparison = null)
	{
		if ($seat instanceof Seat) {
			return $this
				->addUsingAlias(RowPeer::ID, $seat->getrowId(), $comparison);
		} elseif ($seat instanceof PropelCollection) {
			return $this
				->useRowToSeatQuery()
				->filterByPrimaryKeys($seat->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRowToSeat() only accepts arguments of type Seat or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RowToSeat relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function joinRowToSeat($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RowToSeat');

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
			$this->addJoinObject($join, 'RowToSeat');
		}

		return $this;
	}

	/**
	 * Use the RowToSeat relation Seat object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatQuery A secondary query class using the current class as primary query
	 */
	public function useRowToSeatQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinRowToSeat($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RowToSeat', 'SeatQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Row $row Object to remove from the list of results
	 *
	 * @return    RowQuery The current query, for fluid interface
	 */
	public function prune($row = null)
	{
		if ($row) {
			$this->addUsingAlias(RowPeer::ID, $row->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseRowQuery
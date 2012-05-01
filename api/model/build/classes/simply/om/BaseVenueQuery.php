<?php


/**
 * Base class that represents a query for the 'venue' table.
 *
 * 
 *
 * @method     VenueQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     VenueQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     VenueQuery orderByaddress($order = Criteria::ASC) Order by the address column
 *
 * @method     VenueQuery groupByid() Group by the id column
 * @method     VenueQuery groupByname() Group by the name column
 * @method     VenueQuery groupByaddress() Group by the address column
 *
 * @method     VenueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     VenueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     VenueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     VenueQuery leftJoinVenueToShow($relationAlias = null) Adds a LEFT JOIN clause to the query using the VenueToShow relation
 * @method     VenueQuery rightJoinVenueToShow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VenueToShow relation
 * @method     VenueQuery innerJoinVenueToShow($relationAlias = null) Adds a INNER JOIN clause to the query using the VenueToShow relation
 *
 * @method     VenueQuery leftJoinVenueToRow($relationAlias = null) Adds a LEFT JOIN clause to the query using the VenueToRow relation
 * @method     VenueQuery rightJoinVenueToRow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VenueToRow relation
 * @method     VenueQuery innerJoinVenueToRow($relationAlias = null) Adds a INNER JOIN clause to the query using the VenueToRow relation
 *
 * @method     Venue findOne(PropelPDO $con = null) Return the first Venue matching the query
 * @method     Venue findOneOrCreate(PropelPDO $con = null) Return the first Venue matching the query, or a new Venue object populated from the query conditions when no match is found
 *
 * @method     Venue findOneByid(int $id) Return the first Venue filtered by the id column
 * @method     Venue findOneByname(string $name) Return the first Venue filtered by the name column
 * @method     Venue findOneByaddress(string $address) Return the first Venue filtered by the address column
 *
 * @method     array findByid(int $id) Return Venue objects filtered by the id column
 * @method     array findByname(string $name) Return Venue objects filtered by the name column
 * @method     array findByaddress(string $address) Return Venue objects filtered by the address column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseVenueQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseVenueQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Venue', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new VenueQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    VenueQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof VenueQuery) {
			return $criteria;
		}
		$query = new VenueQuery();
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
	 * @return    Venue|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = VenuePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(VenuePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Venue A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `ADDRESS` FROM `venue` WHERE `ID` = :p0';
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
			$obj = new Venue();
			$obj->hydrate($row);
			VenuePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Venue|array|mixed the result, formatted by the current formatter
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
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(VenuePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(VenuePeer::ID, $keys, Criteria::IN);
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
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(VenuePeer::ID, $id, $comparison);
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
	 * @return    VenueQuery The current query, for fluid interface
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
		return $this->addUsingAlias(VenuePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the address column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByaddress('fooValue');   // WHERE address = 'fooValue'
	 * $query->filterByaddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $address The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByaddress($address = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($address)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $address)) {
				$address = str_replace('*', '%', $address);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VenuePeer::ADDRESS, $address, $comparison);
	}

	/**
	 * Filter the query by a related Performance object
	 *
	 * @param     Performance $performance  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByVenueToShow($performance, $comparison = null)
	{
		if ($performance instanceof Performance) {
			return $this
				->addUsingAlias(VenuePeer::ID, $performance->getvenueId(), $comparison);
		} elseif ($performance instanceof PropelCollection) {
			return $this
				->useVenueToShowQuery()
				->filterByPrimaryKeys($performance->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByVenueToShow() only accepts arguments of type Performance or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the VenueToShow relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function joinVenueToShow($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('VenueToShow');

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
			$this->addJoinObject($join, 'VenueToShow');
		}

		return $this;
	}

	/**
	 * Use the VenueToShow relation Performance object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery A secondary query class using the current class as primary query
	 */
	public function useVenueToShowQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVenueToShow($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'VenueToShow', 'PerformanceQuery');
	}

	/**
	 * Filter the query by a related Row object
	 *
	 * @param     Row $row  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function filterByVenueToRow($row, $comparison = null)
	{
		if ($row instanceof Row) {
			return $this
				->addUsingAlias(VenuePeer::ID, $row->getvenueId(), $comparison);
		} elseif ($row instanceof PropelCollection) {
			return $this
				->useVenueToRowQuery()
				->filterByPrimaryKeys($row->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByVenueToRow() only accepts arguments of type Row or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the VenueToRow relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function joinVenueToRow($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('VenueToRow');

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
			$this->addJoinObject($join, 'VenueToRow');
		}

		return $this;
	}

	/**
	 * Use the VenueToRow relation Row object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RowQuery A secondary query class using the current class as primary query
	 */
	public function useVenueToRowQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVenueToRow($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'VenueToRow', 'RowQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Venue $venue Object to remove from the list of results
	 *
	 * @return    VenueQuery The current query, for fluid interface
	 */
	public function prune($venue = null)
	{
		if ($venue) {
			$this->addUsingAlias(VenuePeer::ID, $venue->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseVenueQuery
<?php


/**
 * Base class that represents a query for the 'order' table.
 *
 * 
 *
 * @method     OrderQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     OrderQuery orderBywhen($order = Criteria::ASC) Order by the when column
 * @method     OrderQuery orderByfullName($order = Criteria::ASC) Order by the fullName column
 * @method     OrderQuery orderByemail($order = Criteria::ASC) Order by the email column
 * @method     OrderQuery orderByphone($order = Criteria::ASC) Order by the phone column
 * @method     OrderQuery orderByPerformanceid($order = Criteria::ASC) Order by the performanceId column
 *
 * @method     OrderQuery groupByid() Group by the id column
 * @method     OrderQuery groupBywhen() Group by the when column
 * @method     OrderQuery groupByfullName() Group by the fullName column
 * @method     OrderQuery groupByemail() Group by the email column
 * @method     OrderQuery groupByphone() Group by the phone column
 * @method     OrderQuery groupByPerformanceid() Group by the performanceId column
 *
 * @method     OrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     OrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     OrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     OrderQuery leftJoinPerformance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Performance relation
 * @method     OrderQuery rightJoinPerformance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Performance relation
 * @method     OrderQuery innerJoinPerformance($relationAlias = null) Adds a INNER JOIN clause to the query using the Performance relation
 *
 * @method     OrderQuery leftJoinOrderToSeatOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderToSeatOrder relation
 * @method     OrderQuery rightJoinOrderToSeatOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderToSeatOrder relation
 * @method     OrderQuery innerJoinOrderToSeatOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderToSeatOrder relation
 *
 * @method     OrderQuery leftJoinOrderToTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderToTicketType relation
 * @method     OrderQuery rightJoinOrderToTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderToTicketType relation
 * @method     OrderQuery innerJoinOrderToTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderToTicketType relation
 *
 * @method     Order findOne(PropelPDO $con = null) Return the first Order matching the query
 * @method     Order findOneOrCreate(PropelPDO $con = null) Return the first Order matching the query, or a new Order object populated from the query conditions when no match is found
 *
 * @method     Order findOneByid(int $id) Return the first Order filtered by the id column
 * @method     Order findOneBywhen(string $when) Return the first Order filtered by the when column
 * @method     Order findOneByfullName(string $fullName) Return the first Order filtered by the fullName column
 * @method     Order findOneByemail(string $email) Return the first Order filtered by the email column
 * @method     Order findOneByphone(string $phone) Return the first Order filtered by the phone column
 * @method     Order findOneByPerformanceid(int $performanceId) Return the first Order filtered by the performanceId column
 *
 * @method     array findByid(int $id) Return Order objects filtered by the id column
 * @method     array findBywhen(string $when) Return Order objects filtered by the when column
 * @method     array findByfullName(string $fullName) Return Order objects filtered by the fullName column
 * @method     array findByemail(string $email) Return Order objects filtered by the email column
 * @method     array findByphone(string $phone) Return Order objects filtered by the phone column
 * @method     array findByPerformanceid(int $performanceId) Return Order objects filtered by the performanceId column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseOrderQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseOrderQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Order', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new OrderQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    OrderQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof OrderQuery) {
			return $criteria;
		}
		$query = new OrderQuery();
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
	 * @return    Order|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = OrderPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(OrderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Order A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `WHEN`, `FULLNAME`, `EMAIL`, `PHONE`, `PERFORMANCEID` FROM `order` WHERE `ID` = :p0';
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
			$obj = new Order();
			$obj->hydrate($row);
			OrderPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Order|array|mixed the result, formatted by the current formatter
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
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(OrderPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(OrderPeer::ID, $keys, Criteria::IN);
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
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(OrderPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the when column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBywhen('2011-03-14'); // WHERE when = '2011-03-14'
	 * $query->filterBywhen('now'); // WHERE when = '2011-03-14'
	 * $query->filterBywhen(array('max' => 'yesterday')); // WHERE when > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $when The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterBywhen($when = null, $comparison = null)
	{
		if (is_array($when)) {
			$useMinMax = false;
			if (isset($when['min'])) {
				$this->addUsingAlias(OrderPeer::WHEN, $when['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($when['max'])) {
				$this->addUsingAlias(OrderPeer::WHEN, $when['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderPeer::WHEN, $when, $comparison);
	}

	/**
	 * Filter the query on the fullName column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByfullName('fooValue');   // WHERE fullName = 'fooValue'
	 * $query->filterByfullName('%fooValue%'); // WHERE fullName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fullName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByfullName($fullName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fullName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fullName)) {
				$fullName = str_replace('*', '%', $fullName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(OrderPeer::FULLNAME, $fullName, $comparison);
	}

	/**
	 * Filter the query on the email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByemail('fooValue');   // WHERE email = 'fooValue'
	 * $query->filterByemail('%fooValue%'); // WHERE email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $email The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByemail($email = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($email)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $email)) {
				$email = str_replace('*', '%', $email);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(OrderPeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the phone column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByphone('fooValue');   // WHERE phone = 'fooValue'
	 * $query->filterByphone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $phone The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByphone($phone = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($phone)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $phone)) {
				$phone = str_replace('*', '%', $phone);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(OrderPeer::PHONE, $phone, $comparison);
	}

	/**
	 * Filter the query on the performanceId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPerformanceid(1234); // WHERE performanceId = 1234
	 * $query->filterByPerformanceid(array(12, 34)); // WHERE performanceId IN (12, 34)
	 * $query->filterByPerformanceid(array('min' => 12)); // WHERE performanceId > 12
	 * </code>
	 *
	 * @see       filterByPerformance()
	 *
	 * @param     mixed $performanceid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByPerformanceid($performanceid = null, $comparison = null)
	{
		if (is_array($performanceid)) {
			$useMinMax = false;
			if (isset($performanceid['min'])) {
				$this->addUsingAlias(OrderPeer::PERFORMANCEID, $performanceid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($performanceid['max'])) {
				$this->addUsingAlias(OrderPeer::PERFORMANCEID, $performanceid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderPeer::PERFORMANCEID, $performanceid, $comparison);
	}

	/**
	 * Filter the query by a related Performance object
	 *
	 * @param     Performance|PropelCollection $performance The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByPerformance($performance, $comparison = null)
	{
		if ($performance instanceof Performance) {
			return $this
				->addUsingAlias(OrderPeer::PERFORMANCEID, $performance->getid(), $comparison);
		} elseif ($performance instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OrderPeer::PERFORMANCEID, $performance->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByPerformance() only accepts arguments of type Performance or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Performance relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function joinPerformance($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Performance');

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
			$this->addJoinObject($join, 'Performance');
		}

		return $this;
	}

	/**
	 * Use the Performance relation Performance object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery A secondary query class using the current class as primary query
	 */
	public function usePerformanceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPerformance($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Performance', 'PerformanceQuery');
	}

	/**
	 * Filter the query by a related OrderSeat object
	 *
	 * @param     OrderSeat $orderSeat  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByOrderToSeatOrder($orderSeat, $comparison = null)
	{
		if ($orderSeat instanceof OrderSeat) {
			return $this
				->addUsingAlias(OrderPeer::ID, $orderSeat->getorderId(), $comparison);
		} elseif ($orderSeat instanceof PropelCollection) {
			return $this
				->useOrderToSeatOrderQuery()
				->filterByPrimaryKeys($orderSeat->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByOrderToSeatOrder() only accepts arguments of type OrderSeat or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the OrderToSeatOrder relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function joinOrderToSeatOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('OrderToSeatOrder');

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
			$this->addJoinObject($join, 'OrderToSeatOrder');
		}

		return $this;
	}

	/**
	 * Use the OrderToSeatOrder relation OrderSeat object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderSeatQuery A secondary query class using the current class as primary query
	 */
	public function useOrderToSeatOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinOrderToSeatOrder($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'OrderToSeatOrder', 'OrderSeatQuery');
	}

	/**
	 * Filter the query by a related OrderTicketType object
	 *
	 * @param     OrderTicketType $orderTicketType  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function filterByOrderToTicketType($orderTicketType, $comparison = null)
	{
		if ($orderTicketType instanceof OrderTicketType) {
			return $this
				->addUsingAlias(OrderPeer::ID, $orderTicketType->getorderId(), $comparison);
		} elseif ($orderTicketType instanceof PropelCollection) {
			return $this
				->useOrderToTicketTypeQuery()
				->filterByPrimaryKeys($orderTicketType->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByOrderToTicketType() only accepts arguments of type OrderTicketType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the OrderToTicketType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function joinOrderToTicketType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('OrderToTicketType');

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
			$this->addJoinObject($join, 'OrderToTicketType');
		}

		return $this;
	}

	/**
	 * Use the OrderToTicketType relation OrderTicketType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderTicketTypeQuery A secondary query class using the current class as primary query
	 */
	public function useOrderToTicketTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinOrderToTicketType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'OrderToTicketType', 'OrderTicketTypeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Order $order Object to remove from the list of results
	 *
	 * @return    OrderQuery The current query, for fluid interface
	 */
	public function prune($order = null)
	{
		if ($order) {
			$this->addUsingAlias(OrderPeer::ID, $order->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseOrderQuery
<?php


/**
 * Base class that represents a row from the 'order' table.
 *
 * 
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseOrder extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'OrderPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        OrderPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the when field.
	 * @var        string
	 */
	protected $when;

	/**
	 * The value for the fullname field.
	 * @var        string
	 */
	protected $fullname;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the phone field.
	 * @var        string
	 */
	protected $phone;

	/**
	 * The value for the fulfilled field.
	 * @var        boolean
	 */
	protected $fulfilled;

	/**
	 * The value for the performanceid field.
	 * @var        int
	 */
	protected $performanceid;

	/**
	 * @var        Performance
	 */
	protected $aPerformance;

	/**
	 * @var        array OrderSeat[] Collection to store aggregation of OrderSeat objects.
	 */
	protected $collOrderToSeatOrders;

	/**
	 * @var        array OrderTicketType[] Collection to store aggregation of OrderTicketType objects.
	 */
	protected $collOrderToTicketTypes;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $orderToSeatOrdersScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $orderToTicketTypesScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getid()
	{
		return $this->id;
	}

	/**
	 * Get the [optionally formatted] temporal [when] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getwhen($format = 'Y-m-d H:i:s')
	{
		if ($this->when === null) {
			return null;
		}


		if ($this->when === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->when);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->when, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [fullname] column value.
	 * 
	 * @return     string
	 */
	public function getfullName()
	{
		return $this->fullname;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getemail()
	{
		return $this->email;
	}

	/**
	 * Get the [phone] column value.
	 * 
	 * @return     string
	 */
	public function getphone()
	{
		return $this->phone;
	}

	/**
	 * Get the [fulfilled] column value.
	 * 
	 * @return     boolean
	 */
	public function getfulfilled()
	{
		return $this->fulfilled;
	}

	/**
	 * Get the [performanceid] column value.
	 * 
	 * @return     int
	 */
	public function getPerformanceid()
	{
		return $this->performanceid;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OrderPeer::ID;
		}

		return $this;
	} // setid()

	/**
	 * Sets the value of [when] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Order The current object (for fluent API support)
	 */
	public function setwhen($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->when !== null || $dt !== null) {
			$currentDateAsString = ($this->when !== null && $tmpDt = new DateTime($this->when)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->when = $newDateAsString;
				$this->modifiedColumns[] = OrderPeer::WHEN;
			}
		} // if either are not null

		return $this;
	} // setwhen()

	/**
	 * Set the value of [fullname] column.
	 * 
	 * @param      string $v new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setfullName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->fullname !== $v) {
			$this->fullname = $v;
			$this->modifiedColumns[] = OrderPeer::FULLNAME;
		}

		return $this;
	} // setfullName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setemail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = OrderPeer::EMAIL;
		}

		return $this;
	} // setemail()

	/**
	 * Set the value of [phone] column.
	 * 
	 * @param      string $v new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setphone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = OrderPeer::PHONE;
		}

		return $this;
	} // setphone()

	/**
	 * Sets the value of the [fulfilled] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setfulfilled($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->fulfilled !== $v) {
			$this->fulfilled = $v;
			$this->modifiedColumns[] = OrderPeer::FULFILLED;
		}

		return $this;
	} // setfulfilled()

	/**
	 * Set the value of [performanceid] column.
	 * 
	 * @param      int $v new value
	 * @return     Order The current object (for fluent API support)
	 */
	public function setPerformanceid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->performanceid !== $v) {
			$this->performanceid = $v;
			$this->modifiedColumns[] = OrderPeer::PERFORMANCEID;
		}

		if ($this->aPerformance !== null && $this->aPerformance->getid() !== $v) {
			$this->aPerformance = null;
		}

		return $this;
	} // setPerformanceid()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->when = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->fullname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->phone = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->fulfilled = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->performanceid = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = OrderPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Order object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aPerformance !== null && $this->performanceid !== $this->aPerformance->getid()) {
			$this->aPerformance = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = OrderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPerformance = null;
			$this->collOrderToSeatOrders = null;

			$this->collOrderToTicketTypes = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = OrderQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				OrderPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPerformance !== null) {
				if ($this->aPerformance->isModified() || $this->aPerformance->isNew()) {
					$affectedRows += $this->aPerformance->save($con);
				}
				$this->setPerformance($this->aPerformance);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->orderToSeatOrdersScheduledForDeletion !== null) {
				if (!$this->orderToSeatOrdersScheduledForDeletion->isEmpty()) {
					OrderSeatQuery::create()
						->filterByPrimaryKeys($this->orderToSeatOrdersScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->orderToSeatOrdersScheduledForDeletion = null;
				}
			}

			if ($this->collOrderToSeatOrders !== null) {
				foreach ($this->collOrderToSeatOrders as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->orderToTicketTypesScheduledForDeletion !== null) {
				if (!$this->orderToTicketTypesScheduledForDeletion->isEmpty()) {
					OrderTicketTypeQuery::create()
						->filterByPrimaryKeys($this->orderToTicketTypesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->orderToTicketTypesScheduledForDeletion = null;
				}
			}

			if ($this->collOrderToTicketTypes !== null) {
				foreach ($this->collOrderToTicketTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = OrderPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrderPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(OrderPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(OrderPeer::WHEN)) {
			$modifiedColumns[':p' . $index++]  = '`WHEN`';
		}
		if ($this->isColumnModified(OrderPeer::FULLNAME)) {
			$modifiedColumns[':p' . $index++]  = '`FULLNAME`';
		}
		if ($this->isColumnModified(OrderPeer::EMAIL)) {
			$modifiedColumns[':p' . $index++]  = '`EMAIL`';
		}
		if ($this->isColumnModified(OrderPeer::PHONE)) {
			$modifiedColumns[':p' . $index++]  = '`PHONE`';
		}
		if ($this->isColumnModified(OrderPeer::FULFILLED)) {
			$modifiedColumns[':p' . $index++]  = '`FULFILLED`';
		}
		if ($this->isColumnModified(OrderPeer::PERFORMANCEID)) {
			$modifiedColumns[':p' . $index++]  = '`PERFORMANCEID`';
		}

		$sql = sprintf(
			'INSERT INTO `order` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`WHEN`':
						$stmt->bindValue($identifier, $this->when, PDO::PARAM_STR);
						break;
					case '`FULLNAME`':
						$stmt->bindValue($identifier, $this->fullname, PDO::PARAM_STR);
						break;
					case '`EMAIL`':
						$stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
						break;
					case '`PHONE`':
						$stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
						break;
					case '`FULFILLED`':
						$stmt->bindValue($identifier, (int) $this->fulfilled, PDO::PARAM_INT);
						break;
					case '`PERFORMANCEID`':
						$stmt->bindValue($identifier, $this->performanceid, PDO::PARAM_INT);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setid($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPerformance !== null) {
				if (!$this->aPerformance->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerformance->getValidationFailures());
				}
			}


			if (($retval = OrderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOrderToSeatOrders !== null) {
					foreach ($this->collOrderToSeatOrders as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderToTicketTypes !== null) {
					foreach ($this->collOrderToTicketTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getid();
				break;
			case 1:
				return $this->getwhen();
				break;
			case 2:
				return $this->getfullName();
				break;
			case 3:
				return $this->getemail();
				break;
			case 4:
				return $this->getphone();
				break;
			case 5:
				return $this->getfulfilled();
				break;
			case 6:
				return $this->getPerformanceid();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Order'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Order'][$this->getPrimaryKey()] = true;
		$keys = OrderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getid(),
			$keys[1] => $this->getwhen(),
			$keys[2] => $this->getfullName(),
			$keys[3] => $this->getemail(),
			$keys[4] => $this->getphone(),
			$keys[5] => $this->getfulfilled(),
			$keys[6] => $this->getPerformanceid(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aPerformance) {
				$result['Performance'] = $this->aPerformance->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collOrderToSeatOrders) {
				$result['OrderToSeatOrders'] = $this->collOrderToSeatOrders->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collOrderToTicketTypes) {
				$result['OrderToTicketTypes'] = $this->collOrderToTicketTypes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setid($value);
				break;
			case 1:
				$this->setwhen($value);
				break;
			case 2:
				$this->setfullName($value);
				break;
			case 3:
				$this->setemail($value);
				break;
			case 4:
				$this->setphone($value);
				break;
			case 5:
				$this->setfulfilled($value);
				break;
			case 6:
				$this->setPerformanceid($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setwhen($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setfullName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setemail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setphone($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setfulfilled($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPerformanceid($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(OrderPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrderPeer::ID)) $criteria->add(OrderPeer::ID, $this->id);
		if ($this->isColumnModified(OrderPeer::WHEN)) $criteria->add(OrderPeer::WHEN, $this->when);
		if ($this->isColumnModified(OrderPeer::FULLNAME)) $criteria->add(OrderPeer::FULLNAME, $this->fullname);
		if ($this->isColumnModified(OrderPeer::EMAIL)) $criteria->add(OrderPeer::EMAIL, $this->email);
		if ($this->isColumnModified(OrderPeer::PHONE)) $criteria->add(OrderPeer::PHONE, $this->phone);
		if ($this->isColumnModified(OrderPeer::FULFILLED)) $criteria->add(OrderPeer::FULFILLED, $this->fulfilled);
		if ($this->isColumnModified(OrderPeer::PERFORMANCEID)) $criteria->add(OrderPeer::PERFORMANCEID, $this->performanceid);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrderPeer::DATABASE_NAME);
		$criteria->add(OrderPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getid();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setid($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getid();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Order (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setwhen($this->getwhen());
		$copyObj->setfullName($this->getfullName());
		$copyObj->setemail($this->getemail());
		$copyObj->setphone($this->getphone());
		$copyObj->setfulfilled($this->getfulfilled());
		$copyObj->setPerformanceid($this->getPerformanceid());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getOrderToSeatOrders() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addOrderToSeatOrder($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOrderToTicketTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addOrderToTicketType($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setid(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Order Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     OrderPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OrderPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Performance object.
	 *
	 * @param      Performance $v
	 * @return     Order The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPerformance(Performance $v = null)
	{
		if ($v === null) {
			$this->setPerformanceid(NULL);
		} else {
			$this->setPerformanceid($v->getid());
		}

		$this->aPerformance = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Performance object, it will not be re-added.
		if ($v !== null) {
			$v->addPerformanceToOrder($this);
		}

		return $this;
	}


	/**
	 * Get the associated Performance object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Performance The associated Performance object.
	 * @throws     PropelException
	 */
	public function getPerformance(PropelPDO $con = null)
	{
		if ($this->aPerformance === null && ($this->performanceid !== null)) {
			$this->aPerformance = PerformanceQuery::create()->findPk($this->performanceid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aPerformance->addPerformanceToOrders($this);
			 */
		}
		return $this->aPerformance;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('OrderToSeatOrder' == $relationName) {
			return $this->initOrderToSeatOrders();
		}
		if ('OrderToTicketType' == $relationName) {
			return $this->initOrderToTicketTypes();
		}
	}

	/**
	 * Clears out the collOrderToSeatOrders collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addOrderToSeatOrders()
	 */
	public function clearOrderToSeatOrders()
	{
		$this->collOrderToSeatOrders = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collOrderToSeatOrders collection.
	 *
	 * By default this just sets the collOrderToSeatOrders collection to an empty array (like clearcollOrderToSeatOrders());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initOrderToSeatOrders($overrideExisting = true)
	{
		if (null !== $this->collOrderToSeatOrders && !$overrideExisting) {
			return;
		}
		$this->collOrderToSeatOrders = new PropelObjectCollection();
		$this->collOrderToSeatOrders->setModel('OrderSeat');
	}

	/**
	 * Gets an array of OrderSeat objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Order is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array OrderSeat[] List of OrderSeat objects
	 * @throws     PropelException
	 */
	public function getOrderToSeatOrders($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collOrderToSeatOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collOrderToSeatOrders) {
				// return empty collection
				$this->initOrderToSeatOrders();
			} else {
				$collOrderToSeatOrders = OrderSeatQuery::create(null, $criteria)
					->filterByOrder($this)
					->find($con);
				if (null !== $criteria) {
					return $collOrderToSeatOrders;
				}
				$this->collOrderToSeatOrders = $collOrderToSeatOrders;
			}
		}
		return $this->collOrderToSeatOrders;
	}

	/**
	 * Sets a collection of OrderToSeatOrder objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $orderToSeatOrders A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setOrderToSeatOrders(PropelCollection $orderToSeatOrders, PropelPDO $con = null)
	{
		$this->orderToSeatOrdersScheduledForDeletion = $this->getOrderToSeatOrders(new Criteria(), $con)->diff($orderToSeatOrders);

		foreach ($orderToSeatOrders as $orderToSeatOrder) {
			// Fix issue with collection modified by reference
			if ($orderToSeatOrder->isNew()) {
				$orderToSeatOrder->setOrder($this);
			}
			$this->addOrderToSeatOrder($orderToSeatOrder);
		}

		$this->collOrderToSeatOrders = $orderToSeatOrders;
	}

	/**
	 * Returns the number of related OrderSeat objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related OrderSeat objects.
	 * @throws     PropelException
	 */
	public function countOrderToSeatOrders(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collOrderToSeatOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collOrderToSeatOrders) {
				return 0;
			} else {
				$query = OrderSeatQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByOrder($this)
					->count($con);
			}
		} else {
			return count($this->collOrderToSeatOrders);
		}
	}

	/**
	 * Method called to associate a OrderSeat object to this object
	 * through the OrderSeat foreign key attribute.
	 *
	 * @param      OrderSeat $l OrderSeat
	 * @return     Order The current object (for fluent API support)
	 */
	public function addOrderToSeatOrder(OrderSeat $l)
	{
		if ($this->collOrderToSeatOrders === null) {
			$this->initOrderToSeatOrders();
		}
		if (!$this->collOrderToSeatOrders->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddOrderToSeatOrder($l);
		}

		return $this;
	}

	/**
	 * @param	OrderToSeatOrder $orderToSeatOrder The orderToSeatOrder object to add.
	 */
	protected function doAddOrderToSeatOrder($orderToSeatOrder)
	{
		$this->collOrderToSeatOrders[]= $orderToSeatOrder;
		$orderToSeatOrder->setOrder($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Order is new, it will return
	 * an empty collection; or if this Order has previously
	 * been saved, it will retrieve related OrderToSeatOrders from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Order.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array OrderSeat[] List of OrderSeat objects
	 */
	public function getOrderToSeatOrdersJoinSeat($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = OrderSeatQuery::create(null, $criteria);
		$query->joinWith('Seat', $join_behavior);

		return $this->getOrderToSeatOrders($query, $con);
	}

	/**
	 * Clears out the collOrderToTicketTypes collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addOrderToTicketTypes()
	 */
	public function clearOrderToTicketTypes()
	{
		$this->collOrderToTicketTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collOrderToTicketTypes collection.
	 *
	 * By default this just sets the collOrderToTicketTypes collection to an empty array (like clearcollOrderToTicketTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initOrderToTicketTypes($overrideExisting = true)
	{
		if (null !== $this->collOrderToTicketTypes && !$overrideExisting) {
			return;
		}
		$this->collOrderToTicketTypes = new PropelObjectCollection();
		$this->collOrderToTicketTypes->setModel('OrderTicketType');
	}

	/**
	 * Gets an array of OrderTicketType objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Order is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array OrderTicketType[] List of OrderTicketType objects
	 * @throws     PropelException
	 */
	public function getOrderToTicketTypes($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collOrderToTicketTypes || null !== $criteria) {
			if ($this->isNew() && null === $this->collOrderToTicketTypes) {
				// return empty collection
				$this->initOrderToTicketTypes();
			} else {
				$collOrderToTicketTypes = OrderTicketTypeQuery::create(null, $criteria)
					->filterByOrder($this)
					->find($con);
				if (null !== $criteria) {
					return $collOrderToTicketTypes;
				}
				$this->collOrderToTicketTypes = $collOrderToTicketTypes;
			}
		}
		return $this->collOrderToTicketTypes;
	}

	/**
	 * Sets a collection of OrderToTicketType objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $orderToTicketTypes A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setOrderToTicketTypes(PropelCollection $orderToTicketTypes, PropelPDO $con = null)
	{
		$this->orderToTicketTypesScheduledForDeletion = $this->getOrderToTicketTypes(new Criteria(), $con)->diff($orderToTicketTypes);

		foreach ($orderToTicketTypes as $orderToTicketType) {
			// Fix issue with collection modified by reference
			if ($orderToTicketType->isNew()) {
				$orderToTicketType->setOrder($this);
			}
			$this->addOrderToTicketType($orderToTicketType);
		}

		$this->collOrderToTicketTypes = $orderToTicketTypes;
	}

	/**
	 * Returns the number of related OrderTicketType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related OrderTicketType objects.
	 * @throws     PropelException
	 */
	public function countOrderToTicketTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collOrderToTicketTypes || null !== $criteria) {
			if ($this->isNew() && null === $this->collOrderToTicketTypes) {
				return 0;
			} else {
				$query = OrderTicketTypeQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByOrder($this)
					->count($con);
			}
		} else {
			return count($this->collOrderToTicketTypes);
		}
	}

	/**
	 * Method called to associate a OrderTicketType object to this object
	 * through the OrderTicketType foreign key attribute.
	 *
	 * @param      OrderTicketType $l OrderTicketType
	 * @return     Order The current object (for fluent API support)
	 */
	public function addOrderToTicketType(OrderTicketType $l)
	{
		if ($this->collOrderToTicketTypes === null) {
			$this->initOrderToTicketTypes();
		}
		if (!$this->collOrderToTicketTypes->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddOrderToTicketType($l);
		}

		return $this;
	}

	/**
	 * @param	OrderToTicketType $orderToTicketType The orderToTicketType object to add.
	 */
	protected function doAddOrderToTicketType($orderToTicketType)
	{
		$this->collOrderToTicketTypes[]= $orderToTicketType;
		$orderToTicketType->setOrder($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Order is new, it will return
	 * an empty collection; or if this Order has previously
	 * been saved, it will retrieve related OrderToTicketTypes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Order.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array OrderTicketType[] List of OrderTicketType objects
	 */
	public function getOrderToTicketTypesJoinTicketType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = OrderTicketTypeQuery::create(null, $criteria);
		$query->joinWith('TicketType', $join_behavior);

		return $this->getOrderToTicketTypes($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->when = null;
		$this->fullname = null;
		$this->email = null;
		$this->phone = null;
		$this->fulfilled = null;
		$this->performanceid = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collOrderToSeatOrders) {
				foreach ($this->collOrderToSeatOrders as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOrderToTicketTypes) {
				foreach ($this->collOrderToTicketTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collOrderToSeatOrders instanceof PropelCollection) {
			$this->collOrderToSeatOrders->clearIterator();
		}
		$this->collOrderToSeatOrders = null;
		if ($this->collOrderToTicketTypes instanceof PropelCollection) {
			$this->collOrderToTicketTypes->clearIterator();
		}
		$this->collOrderToTicketTypes = null;
		$this->aPerformance = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(OrderPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseOrder

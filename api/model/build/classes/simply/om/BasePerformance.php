<?php


/**
 * Base class that represents a row from the 'performance' table.
 *
 * 
 *
 * @package    propel.generator.simply.om
 */
abstract class BasePerformance extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'PerformancePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PerformancePeer
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
	 * The value for the showid field.
	 * @var        int
	 */
	protected $showid;

	/**
	 * The value for the venueid field.
	 * @var        int
	 */
	protected $venueid;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * @var        Show
	 */
	protected $aShow;

	/**
	 * @var        Venue
	 */
	protected $aVenue;

	/**
	 * @var        array TicketType[] Collection to store aggregation of TicketType objects.
	 */
	protected $collPerformanceToTicketTypes;

	/**
	 * @var        array SeatAvailability[] Collection to store aggregation of SeatAvailability objects.
	 */
	protected $collPerformanceToAvailabilitys;

	/**
	 * @var        array Order[] Collection to store aggregation of Order objects.
	 */
	protected $collPerformanceToOrders;

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
	protected $performanceToTicketTypesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $performanceToAvailabilitysScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $performanceToOrdersScheduledForDeletion = null;

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
	 * Get the [showid] column value.
	 * 
	 * @return     int
	 */
	public function getshowId()
	{
		return $this->showid;
	}

	/**
	 * Get the [venueid] column value.
	 * 
	 * @return     int
	 */
	public function getvenueId()
	{
		return $this->venueid;
	}

	/**
	 * Get the [optionally formatted] temporal [name] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getname($format = 'Y-m-d H:i:s')
	{
		if ($this->name === null) {
			return null;
		}


		if ($this->name === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->name);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->name, true), $x);
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Performance The current object (for fluent API support)
	 */
	public function setid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PerformancePeer::ID;
		}

		return $this;
	} // setid()

	/**
	 * Set the value of [showid] column.
	 * 
	 * @param      int $v new value
	 * @return     Performance The current object (for fluent API support)
	 */
	public function setshowId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->showid !== $v) {
			$this->showid = $v;
			$this->modifiedColumns[] = PerformancePeer::SHOWID;
		}

		if ($this->aShow !== null && $this->aShow->getid() !== $v) {
			$this->aShow = null;
		}

		return $this;
	} // setshowId()

	/**
	 * Set the value of [venueid] column.
	 * 
	 * @param      int $v new value
	 * @return     Performance The current object (for fluent API support)
	 */
	public function setvenueId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->venueid !== $v) {
			$this->venueid = $v;
			$this->modifiedColumns[] = PerformancePeer::VENUEID;
		}

		if ($this->aVenue !== null && $this->aVenue->getid() !== $v) {
			$this->aVenue = null;
		}

		return $this;
	} // setvenueId()

	/**
	 * Sets the value of [name] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Performance The current object (for fluent API support)
	 */
	public function setname($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->name !== null || $dt !== null) {
			$currentDateAsString = ($this->name !== null && $tmpDt = new DateTime($this->name)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->name = $newDateAsString;
				$this->modifiedColumns[] = PerformancePeer::NAME;
			}
		} // if either are not null

		return $this;
	} // setname()

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
			$this->showid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->venueid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = PerformancePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Performance object", $e);
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

		if ($this->aShow !== null && $this->showid !== $this->aShow->getid()) {
			$this->aShow = null;
		}
		if ($this->aVenue !== null && $this->venueid !== $this->aVenue->getid()) {
			$this->aVenue = null;
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
			$con = Propel::getConnection(PerformancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PerformancePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aShow = null;
			$this->aVenue = null;
			$this->collPerformanceToTicketTypes = null;

			$this->collPerformanceToAvailabilitys = null;

			$this->collPerformanceToOrders = null;

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
			$con = Propel::getConnection(PerformancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = PerformanceQuery::create()
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
			$con = Propel::getConnection(PerformancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				PerformancePeer::addInstanceToPool($this);
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

			if ($this->aShow !== null) {
				if ($this->aShow->isModified() || $this->aShow->isNew()) {
					$affectedRows += $this->aShow->save($con);
				}
				$this->setShow($this->aShow);
			}

			if ($this->aVenue !== null) {
				if ($this->aVenue->isModified() || $this->aVenue->isNew()) {
					$affectedRows += $this->aVenue->save($con);
				}
				$this->setVenue($this->aVenue);
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

			if ($this->performanceToTicketTypesScheduledForDeletion !== null) {
				if (!$this->performanceToTicketTypesScheduledForDeletion->isEmpty()) {
					TicketTypeQuery::create()
						->filterByPrimaryKeys($this->performanceToTicketTypesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->performanceToTicketTypesScheduledForDeletion = null;
				}
			}

			if ($this->collPerformanceToTicketTypes !== null) {
				foreach ($this->collPerformanceToTicketTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->performanceToAvailabilitysScheduledForDeletion !== null) {
				if (!$this->performanceToAvailabilitysScheduledForDeletion->isEmpty()) {
					SeatAvailabilityQuery::create()
						->filterByPrimaryKeys($this->performanceToAvailabilitysScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->performanceToAvailabilitysScheduledForDeletion = null;
				}
			}

			if ($this->collPerformanceToAvailabilitys !== null) {
				foreach ($this->collPerformanceToAvailabilitys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->performanceToOrdersScheduledForDeletion !== null) {
				if (!$this->performanceToOrdersScheduledForDeletion->isEmpty()) {
					OrderQuery::create()
						->filterByPrimaryKeys($this->performanceToOrdersScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->performanceToOrdersScheduledForDeletion = null;
				}
			}

			if ($this->collPerformanceToOrders !== null) {
				foreach ($this->collPerformanceToOrders as $referrerFK) {
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

		$this->modifiedColumns[] = PerformancePeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . PerformancePeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(PerformancePeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(PerformancePeer::SHOWID)) {
			$modifiedColumns[':p' . $index++]  = '`SHOWID`';
		}
		if ($this->isColumnModified(PerformancePeer::VENUEID)) {
			$modifiedColumns[':p' . $index++]  = '`VENUEID`';
		}
		if ($this->isColumnModified(PerformancePeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}

		$sql = sprintf(
			'INSERT INTO `performance` (%s) VALUES (%s)',
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
					case '`SHOWID`':
						$stmt->bindValue($identifier, $this->showid, PDO::PARAM_INT);
						break;
					case '`VENUEID`':
						$stmt->bindValue($identifier, $this->venueid, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
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

			if ($this->aShow !== null) {
				if (!$this->aShow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aShow->getValidationFailures());
				}
			}

			if ($this->aVenue !== null) {
				if (!$this->aVenue->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVenue->getValidationFailures());
				}
			}


			if (($retval = PerformancePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPerformanceToTicketTypes !== null) {
					foreach ($this->collPerformanceToTicketTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPerformanceToAvailabilitys !== null) {
					foreach ($this->collPerformanceToAvailabilitys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPerformanceToOrders !== null) {
					foreach ($this->collPerformanceToOrders as $referrerFK) {
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
		$pos = PerformancePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getshowId();
				break;
			case 2:
				return $this->getvenueId();
				break;
			case 3:
				return $this->getname();
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
		if (isset($alreadyDumpedObjects['Performance'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Performance'][$this->getPrimaryKey()] = true;
		$keys = PerformancePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getid(),
			$keys[1] => $this->getshowId(),
			$keys[2] => $this->getvenueId(),
			$keys[3] => $this->getname(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aShow) {
				$result['Show'] = $this->aShow->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aVenue) {
				$result['Venue'] = $this->aVenue->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collPerformanceToTicketTypes) {
				$result['PerformanceToTicketTypes'] = $this->collPerformanceToTicketTypes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPerformanceToAvailabilitys) {
				$result['PerformanceToAvailabilitys'] = $this->collPerformanceToAvailabilitys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPerformanceToOrders) {
				$result['PerformanceToOrders'] = $this->collPerformanceToOrders->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = PerformancePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setshowId($value);
				break;
			case 2:
				$this->setvenueId($value);
				break;
			case 3:
				$this->setname($value);
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
		$keys = PerformancePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setshowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setvenueId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setname($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PerformancePeer::DATABASE_NAME);

		if ($this->isColumnModified(PerformancePeer::ID)) $criteria->add(PerformancePeer::ID, $this->id);
		if ($this->isColumnModified(PerformancePeer::SHOWID)) $criteria->add(PerformancePeer::SHOWID, $this->showid);
		if ($this->isColumnModified(PerformancePeer::VENUEID)) $criteria->add(PerformancePeer::VENUEID, $this->venueid);
		if ($this->isColumnModified(PerformancePeer::NAME)) $criteria->add(PerformancePeer::NAME, $this->name);

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
		$criteria = new Criteria(PerformancePeer::DATABASE_NAME);
		$criteria->add(PerformancePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Performance (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setshowId($this->getshowId());
		$copyObj->setvenueId($this->getvenueId());
		$copyObj->setname($this->getname());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getPerformanceToTicketTypes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPerformanceToTicketType($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPerformanceToAvailabilitys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPerformanceToAvailability($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPerformanceToOrders() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPerformanceToOrder($relObj->copy($deepCopy));
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
	 * @return     Performance Clone of current object.
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
	 * @return     PerformancePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PerformancePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Show object.
	 *
	 * @param      Show $v
	 * @return     Performance The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setShow(Show $v = null)
	{
		if ($v === null) {
			$this->setshowId(NULL);
		} else {
			$this->setshowId($v->getid());
		}

		$this->aShow = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Show object, it will not be re-added.
		if ($v !== null) {
			$v->addShowToPerformance($this);
		}

		return $this;
	}


	/**
	 * Get the associated Show object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Show The associated Show object.
	 * @throws     PropelException
	 */
	public function getShow(PropelPDO $con = null)
	{
		if ($this->aShow === null && ($this->showid !== null)) {
			$this->aShow = ShowQuery::create()->findPk($this->showid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aShow->addShowToPerformances($this);
			 */
		}
		return $this->aShow;
	}

	/**
	 * Declares an association between this object and a Venue object.
	 *
	 * @param      Venue $v
	 * @return     Performance The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setVenue(Venue $v = null)
	{
		if ($v === null) {
			$this->setvenueId(NULL);
		} else {
			$this->setvenueId($v->getid());
		}

		$this->aVenue = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Venue object, it will not be re-added.
		if ($v !== null) {
			$v->addVenueToShow($this);
		}

		return $this;
	}


	/**
	 * Get the associated Venue object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Venue The associated Venue object.
	 * @throws     PropelException
	 */
	public function getVenue(PropelPDO $con = null)
	{
		if ($this->aVenue === null && ($this->venueid !== null)) {
			$this->aVenue = VenueQuery::create()->findPk($this->venueid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aVenue->addVenueToShows($this);
			 */
		}
		return $this->aVenue;
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
		if ('PerformanceToTicketType' == $relationName) {
			return $this->initPerformanceToTicketTypes();
		}
		if ('PerformanceToAvailability' == $relationName) {
			return $this->initPerformanceToAvailabilitys();
		}
		if ('PerformanceToOrder' == $relationName) {
			return $this->initPerformanceToOrders();
		}
	}

	/**
	 * Clears out the collPerformanceToTicketTypes collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPerformanceToTicketTypes()
	 */
	public function clearPerformanceToTicketTypes()
	{
		$this->collPerformanceToTicketTypes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPerformanceToTicketTypes collection.
	 *
	 * By default this just sets the collPerformanceToTicketTypes collection to an empty array (like clearcollPerformanceToTicketTypes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPerformanceToTicketTypes($overrideExisting = true)
	{
		if (null !== $this->collPerformanceToTicketTypes && !$overrideExisting) {
			return;
		}
		$this->collPerformanceToTicketTypes = new PropelObjectCollection();
		$this->collPerformanceToTicketTypes->setModel('TicketType');
	}

	/**
	 * Gets an array of TicketType objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Performance is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TicketType[] List of TicketType objects
	 * @throws     PropelException
	 */
	public function getPerformanceToTicketTypes($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToTicketTypes || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToTicketTypes) {
				// return empty collection
				$this->initPerformanceToTicketTypes();
			} else {
				$collPerformanceToTicketTypes = TicketTypeQuery::create(null, $criteria)
					->filterByPerformance($this)
					->find($con);
				if (null !== $criteria) {
					return $collPerformanceToTicketTypes;
				}
				$this->collPerformanceToTicketTypes = $collPerformanceToTicketTypes;
			}
		}
		return $this->collPerformanceToTicketTypes;
	}

	/**
	 * Sets a collection of PerformanceToTicketType objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $performanceToTicketTypes A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPerformanceToTicketTypes(PropelCollection $performanceToTicketTypes, PropelPDO $con = null)
	{
		$this->performanceToTicketTypesScheduledForDeletion = $this->getPerformanceToTicketTypes(new Criteria(), $con)->diff($performanceToTicketTypes);

		foreach ($performanceToTicketTypes as $performanceToTicketType) {
			// Fix issue with collection modified by reference
			if ($performanceToTicketType->isNew()) {
				$performanceToTicketType->setPerformance($this);
			}
			$this->addPerformanceToTicketType($performanceToTicketType);
		}

		$this->collPerformanceToTicketTypes = $performanceToTicketTypes;
	}

	/**
	 * Returns the number of related TicketType objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TicketType objects.
	 * @throws     PropelException
	 */
	public function countPerformanceToTicketTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToTicketTypes || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToTicketTypes) {
				return 0;
			} else {
				$query = TicketTypeQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByPerformance($this)
					->count($con);
			}
		} else {
			return count($this->collPerformanceToTicketTypes);
		}
	}

	/**
	 * Method called to associate a TicketType object to this object
	 * through the TicketType foreign key attribute.
	 *
	 * @param      TicketType $l TicketType
	 * @return     Performance The current object (for fluent API support)
	 */
	public function addPerformanceToTicketType(TicketType $l)
	{
		if ($this->collPerformanceToTicketTypes === null) {
			$this->initPerformanceToTicketTypes();
		}
		if (!$this->collPerformanceToTicketTypes->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPerformanceToTicketType($l);
		}

		return $this;
	}

	/**
	 * @param	PerformanceToTicketType $performanceToTicketType The performanceToTicketType object to add.
	 */
	protected function doAddPerformanceToTicketType($performanceToTicketType)
	{
		$this->collPerformanceToTicketTypes[]= $performanceToTicketType;
		$performanceToTicketType->setPerformance($this);
	}

	/**
	 * Clears out the collPerformanceToAvailabilitys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPerformanceToAvailabilitys()
	 */
	public function clearPerformanceToAvailabilitys()
	{
		$this->collPerformanceToAvailabilitys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPerformanceToAvailabilitys collection.
	 *
	 * By default this just sets the collPerformanceToAvailabilitys collection to an empty array (like clearcollPerformanceToAvailabilitys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPerformanceToAvailabilitys($overrideExisting = true)
	{
		if (null !== $this->collPerformanceToAvailabilitys && !$overrideExisting) {
			return;
		}
		$this->collPerformanceToAvailabilitys = new PropelObjectCollection();
		$this->collPerformanceToAvailabilitys->setModel('SeatAvailability');
	}

	/**
	 * Gets an array of SeatAvailability objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Performance is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SeatAvailability[] List of SeatAvailability objects
	 * @throws     PropelException
	 */
	public function getPerformanceToAvailabilitys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToAvailabilitys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToAvailabilitys) {
				// return empty collection
				$this->initPerformanceToAvailabilitys();
			} else {
				$collPerformanceToAvailabilitys = SeatAvailabilityQuery::create(null, $criteria)
					->filterByPerformance($this)
					->find($con);
				if (null !== $criteria) {
					return $collPerformanceToAvailabilitys;
				}
				$this->collPerformanceToAvailabilitys = $collPerformanceToAvailabilitys;
			}
		}
		return $this->collPerformanceToAvailabilitys;
	}

	/**
	 * Sets a collection of PerformanceToAvailability objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $performanceToAvailabilitys A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPerformanceToAvailabilitys(PropelCollection $performanceToAvailabilitys, PropelPDO $con = null)
	{
		$this->performanceToAvailabilitysScheduledForDeletion = $this->getPerformanceToAvailabilitys(new Criteria(), $con)->diff($performanceToAvailabilitys);

		foreach ($performanceToAvailabilitys as $performanceToAvailability) {
			// Fix issue with collection modified by reference
			if ($performanceToAvailability->isNew()) {
				$performanceToAvailability->setPerformance($this);
			}
			$this->addPerformanceToAvailability($performanceToAvailability);
		}

		$this->collPerformanceToAvailabilitys = $performanceToAvailabilitys;
	}

	/**
	 * Returns the number of related SeatAvailability objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SeatAvailability objects.
	 * @throws     PropelException
	 */
	public function countPerformanceToAvailabilitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToAvailabilitys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToAvailabilitys) {
				return 0;
			} else {
				$query = SeatAvailabilityQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByPerformance($this)
					->count($con);
			}
		} else {
			return count($this->collPerformanceToAvailabilitys);
		}
	}

	/**
	 * Method called to associate a SeatAvailability object to this object
	 * through the SeatAvailability foreign key attribute.
	 *
	 * @param      SeatAvailability $l SeatAvailability
	 * @return     Performance The current object (for fluent API support)
	 */
	public function addPerformanceToAvailability(SeatAvailability $l)
	{
		if ($this->collPerformanceToAvailabilitys === null) {
			$this->initPerformanceToAvailabilitys();
		}
		if (!$this->collPerformanceToAvailabilitys->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPerformanceToAvailability($l);
		}

		return $this;
	}

	/**
	 * @param	PerformanceToAvailability $performanceToAvailability The performanceToAvailability object to add.
	 */
	protected function doAddPerformanceToAvailability($performanceToAvailability)
	{
		$this->collPerformanceToAvailabilitys[]= $performanceToAvailability;
		$performanceToAvailability->setPerformance($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Performance is new, it will return
	 * an empty collection; or if this Performance has previously
	 * been saved, it will retrieve related PerformanceToAvailabilitys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Performance.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SeatAvailability[] List of SeatAvailability objects
	 */
	public function getPerformanceToAvailabilitysJoinSeat($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SeatAvailabilityQuery::create(null, $criteria);
		$query->joinWith('Seat', $join_behavior);

		return $this->getPerformanceToAvailabilitys($query, $con);
	}

	/**
	 * Clears out the collPerformanceToOrders collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPerformanceToOrders()
	 */
	public function clearPerformanceToOrders()
	{
		$this->collPerformanceToOrders = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPerformanceToOrders collection.
	 *
	 * By default this just sets the collPerformanceToOrders collection to an empty array (like clearcollPerformanceToOrders());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPerformanceToOrders($overrideExisting = true)
	{
		if (null !== $this->collPerformanceToOrders && !$overrideExisting) {
			return;
		}
		$this->collPerformanceToOrders = new PropelObjectCollection();
		$this->collPerformanceToOrders->setModel('Order');
	}

	/**
	 * Gets an array of Order objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Performance is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Order[] List of Order objects
	 * @throws     PropelException
	 */
	public function getPerformanceToOrders($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToOrders) {
				// return empty collection
				$this->initPerformanceToOrders();
			} else {
				$collPerformanceToOrders = OrderQuery::create(null, $criteria)
					->filterByPerformance($this)
					->find($con);
				if (null !== $criteria) {
					return $collPerformanceToOrders;
				}
				$this->collPerformanceToOrders = $collPerformanceToOrders;
			}
		}
		return $this->collPerformanceToOrders;
	}

	/**
	 * Sets a collection of PerformanceToOrder objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $performanceToOrders A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPerformanceToOrders(PropelCollection $performanceToOrders, PropelPDO $con = null)
	{
		$this->performanceToOrdersScheduledForDeletion = $this->getPerformanceToOrders(new Criteria(), $con)->diff($performanceToOrders);

		foreach ($performanceToOrders as $performanceToOrder) {
			// Fix issue with collection modified by reference
			if ($performanceToOrder->isNew()) {
				$performanceToOrder->setPerformance($this);
			}
			$this->addPerformanceToOrder($performanceToOrder);
		}

		$this->collPerformanceToOrders = $performanceToOrders;
	}

	/**
	 * Returns the number of related Order objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Order objects.
	 * @throws     PropelException
	 */
	public function countPerformanceToOrders(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPerformanceToOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collPerformanceToOrders) {
				return 0;
			} else {
				$query = OrderQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByPerformance($this)
					->count($con);
			}
		} else {
			return count($this->collPerformanceToOrders);
		}
	}

	/**
	 * Method called to associate a Order object to this object
	 * through the Order foreign key attribute.
	 *
	 * @param      Order $l Order
	 * @return     Performance The current object (for fluent API support)
	 */
	public function addPerformanceToOrder(Order $l)
	{
		if ($this->collPerformanceToOrders === null) {
			$this->initPerformanceToOrders();
		}
		if (!$this->collPerformanceToOrders->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPerformanceToOrder($l);
		}

		return $this;
	}

	/**
	 * @param	PerformanceToOrder $performanceToOrder The performanceToOrder object to add.
	 */
	protected function doAddPerformanceToOrder($performanceToOrder)
	{
		$this->collPerformanceToOrders[]= $performanceToOrder;
		$performanceToOrder->setPerformance($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->showid = null;
		$this->venueid = null;
		$this->name = null;
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
			if ($this->collPerformanceToTicketTypes) {
				foreach ($this->collPerformanceToTicketTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPerformanceToAvailabilitys) {
				foreach ($this->collPerformanceToAvailabilitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPerformanceToOrders) {
				foreach ($this->collPerformanceToOrders as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collPerformanceToTicketTypes instanceof PropelCollection) {
			$this->collPerformanceToTicketTypes->clearIterator();
		}
		$this->collPerformanceToTicketTypes = null;
		if ($this->collPerformanceToAvailabilitys instanceof PropelCollection) {
			$this->collPerformanceToAvailabilitys->clearIterator();
		}
		$this->collPerformanceToAvailabilitys = null;
		if ($this->collPerformanceToOrders instanceof PropelCollection) {
			$this->collPerformanceToOrders->clearIterator();
		}
		$this->collPerformanceToOrders = null;
		$this->aShow = null;
		$this->aVenue = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(PerformancePeer::DEFAULT_STRING_FORMAT);
	}

} // BasePerformance

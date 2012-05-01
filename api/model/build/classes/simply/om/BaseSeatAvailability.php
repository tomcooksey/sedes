<?php


/**
 * Base class that represents a row from the 'seatAvailability' table.
 *
 * 
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseSeatAvailability extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'SeatAvailabilityPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SeatAvailabilityPeer
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
	 * The value for the seatid field.
	 * @var        int
	 */
	protected $seatid;

	/**
	 * The value for the performanceid field.
	 * @var        int
	 */
	protected $performanceid;

	/**
	 * The value for the forsale field.
	 * @var        boolean
	 */
	protected $forsale;

	/**
	 * @var        Seat
	 */
	protected $aSeat;

	/**
	 * @var        Performance
	 */
	protected $aPerformance;

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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getid()
	{
		return $this->id;
	}

	/**
	 * Get the [seatid] column value.
	 * 
	 * @return     int
	 */
	public function getseatId()
	{
		return $this->seatid;
	}

	/**
	 * Get the [performanceid] column value.
	 * 
	 * @return     int
	 */
	public function getperformanceId()
	{
		return $this->performanceid;
	}

	/**
	 * Get the [forsale] column value.
	 * 
	 * @return     boolean
	 */
	public function getforSale()
	{
		return $this->forsale;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SeatAvailability The current object (for fluent API support)
	 */
	public function setid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SeatAvailabilityPeer::ID;
		}

		return $this;
	} // setid()

	/**
	 * Set the value of [seatid] column.
	 * 
	 * @param      int $v new value
	 * @return     SeatAvailability The current object (for fluent API support)
	 */
	public function setseatId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->seatid !== $v) {
			$this->seatid = $v;
			$this->modifiedColumns[] = SeatAvailabilityPeer::SEATID;
		}

		if ($this->aSeat !== null && $this->aSeat->getid() !== $v) {
			$this->aSeat = null;
		}

		return $this;
	} // setseatId()

	/**
	 * Set the value of [performanceid] column.
	 * 
	 * @param      int $v new value
	 * @return     SeatAvailability The current object (for fluent API support)
	 */
	public function setperformanceId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->performanceid !== $v) {
			$this->performanceid = $v;
			$this->modifiedColumns[] = SeatAvailabilityPeer::PERFORMANCEID;
		}

		if ($this->aPerformance !== null && $this->aPerformance->getid() !== $v) {
			$this->aPerformance = null;
		}

		return $this;
	} // setperformanceId()

	/**
	 * Sets the value of the [forsale] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     SeatAvailability The current object (for fluent API support)
	 */
	public function setforSale($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->forsale !== $v) {
			$this->forsale = $v;
			$this->modifiedColumns[] = SeatAvailabilityPeer::FORSALE;
		}

		return $this;
	} // setforSale()

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
			$this->seatid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->performanceid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->forsale = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = SeatAvailabilityPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating SeatAvailability object", $e);
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

		if ($this->aSeat !== null && $this->seatid !== $this->aSeat->getid()) {
			$this->aSeat = null;
		}
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
			$con = Propel::getConnection(SeatAvailabilityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SeatAvailabilityPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSeat = null;
			$this->aPerformance = null;
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
			$con = Propel::getConnection(SeatAvailabilityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = SeatAvailabilityQuery::create()
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
			$con = Propel::getConnection(SeatAvailabilityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SeatAvailabilityPeer::addInstanceToPool($this);
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

			if ($this->aSeat !== null) {
				if ($this->aSeat->isModified() || $this->aSeat->isNew()) {
					$affectedRows += $this->aSeat->save($con);
				}
				$this->setSeat($this->aSeat);
			}

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

		$this->modifiedColumns[] = SeatAvailabilityPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . SeatAvailabilityPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(SeatAvailabilityPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(SeatAvailabilityPeer::SEATID)) {
			$modifiedColumns[':p' . $index++]  = '`SEATID`';
		}
		if ($this->isColumnModified(SeatAvailabilityPeer::PERFORMANCEID)) {
			$modifiedColumns[':p' . $index++]  = '`PERFORMANCEID`';
		}
		if ($this->isColumnModified(SeatAvailabilityPeer::FORSALE)) {
			$modifiedColumns[':p' . $index++]  = '`FORSALE`';
		}

		$sql = sprintf(
			'INSERT INTO `seatAvailability` (%s) VALUES (%s)',
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
					case '`SEATID`':
						$stmt->bindValue($identifier, $this->seatid, PDO::PARAM_INT);
						break;
					case '`PERFORMANCEID`':
						$stmt->bindValue($identifier, $this->performanceid, PDO::PARAM_INT);
						break;
					case '`FORSALE`':
						$stmt->bindValue($identifier, (int) $this->forsale, PDO::PARAM_INT);
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

			if ($this->aSeat !== null) {
				if (!$this->aSeat->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSeat->getValidationFailures());
				}
			}

			if ($this->aPerformance !== null) {
				if (!$this->aPerformance->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerformance->getValidationFailures());
				}
			}


			if (($retval = SeatAvailabilityPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = SeatAvailabilityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getseatId();
				break;
			case 2:
				return $this->getperformanceId();
				break;
			case 3:
				return $this->getforSale();
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
		if (isset($alreadyDumpedObjects['SeatAvailability'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['SeatAvailability'][$this->getPrimaryKey()] = true;
		$keys = SeatAvailabilityPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getid(),
			$keys[1] => $this->getseatId(),
			$keys[2] => $this->getperformanceId(),
			$keys[3] => $this->getforSale(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aSeat) {
				$result['Seat'] = $this->aSeat->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aPerformance) {
				$result['Performance'] = $this->aPerformance->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = SeatAvailabilityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setseatId($value);
				break;
			case 2:
				$this->setperformanceId($value);
				break;
			case 3:
				$this->setforSale($value);
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
		$keys = SeatAvailabilityPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setseatId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setperformanceId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setforSale($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SeatAvailabilityPeer::DATABASE_NAME);

		if ($this->isColumnModified(SeatAvailabilityPeer::ID)) $criteria->add(SeatAvailabilityPeer::ID, $this->id);
		if ($this->isColumnModified(SeatAvailabilityPeer::SEATID)) $criteria->add(SeatAvailabilityPeer::SEATID, $this->seatid);
		if ($this->isColumnModified(SeatAvailabilityPeer::PERFORMANCEID)) $criteria->add(SeatAvailabilityPeer::PERFORMANCEID, $this->performanceid);
		if ($this->isColumnModified(SeatAvailabilityPeer::FORSALE)) $criteria->add(SeatAvailabilityPeer::FORSALE, $this->forsale);

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
		$criteria = new Criteria(SeatAvailabilityPeer::DATABASE_NAME);
		$criteria->add(SeatAvailabilityPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SeatAvailability (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setseatId($this->getseatId());
		$copyObj->setperformanceId($this->getperformanceId());
		$copyObj->setforSale($this->getforSale());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

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
	 * @return     SeatAvailability Clone of current object.
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
	 * @return     SeatAvailabilityPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SeatAvailabilityPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Seat object.
	 *
	 * @param      Seat $v
	 * @return     SeatAvailability The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSeat(Seat $v = null)
	{
		if ($v === null) {
			$this->setseatId(NULL);
		} else {
			$this->setseatId($v->getid());
		}

		$this->aSeat = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Seat object, it will not be re-added.
		if ($v !== null) {
			$v->addSeatToAvailability($this);
		}

		return $this;
	}


	/**
	 * Get the associated Seat object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Seat The associated Seat object.
	 * @throws     PropelException
	 */
	public function getSeat(PropelPDO $con = null)
	{
		if ($this->aSeat === null && ($this->seatid !== null)) {
			$this->aSeat = SeatQuery::create()->findPk($this->seatid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aSeat->addSeatToAvailabilitys($this);
			 */
		}
		return $this->aSeat;
	}

	/**
	 * Declares an association between this object and a Performance object.
	 *
	 * @param      Performance $v
	 * @return     SeatAvailability The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPerformance(Performance $v = null)
	{
		if ($v === null) {
			$this->setperformanceId(NULL);
		} else {
			$this->setperformanceId($v->getid());
		}

		$this->aPerformance = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Performance object, it will not be re-added.
		if ($v !== null) {
			$v->addPerformanceToAvailability($this);
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
				$this->aPerformance->addPerformanceToAvailabilitys($this);
			 */
		}
		return $this->aPerformance;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->seatid = null;
		$this->performanceid = null;
		$this->forsale = null;
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
		} // if ($deep)

		$this->aSeat = null;
		$this->aPerformance = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(SeatAvailabilityPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseSeatAvailability

<?php


/**
 * Base class that represents a row from the 'seat' table.
 *
 * 
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseSeat extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'SeatPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SeatPeer
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
	 * The value for the rowid field.
	 * @var        int
	 */
	protected $rowid;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the number field.
	 * @var        string
	 */
	protected $number;

	/**
	 * The value for the noseat field.
	 * @var        boolean
	 */
	protected $noseat;

	/**
	 * @var        Row
	 */
	protected $aRow;

	/**
	 * @var        array SeatAvailability[] Collection to store aggregation of SeatAvailability objects.
	 */
	protected $collSeatToAvailabilitys;

	/**
	 * @var        array OrderSeat[] Collection to store aggregation of OrderSeat objects.
	 */
	protected $collSeatToOrders;

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
	protected $seatToAvailabilitysScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $seatToOrdersScheduledForDeletion = null;

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
	 * Get the [rowid] column value.
	 * 
	 * @return     int
	 */
	public function getrowId()
	{
		return $this->rowid;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getname()
	{
		return $this->name;
	}

	/**
	 * Get the [number] column value.
	 * 
	 * @return     string
	 */
	public function getnumber()
	{
		return $this->number;
	}

	/**
	 * Get the [noseat] column value.
	 * 
	 * @return     boolean
	 */
	public function getnoSeat()
	{
		return $this->noseat;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Seat The current object (for fluent API support)
	 */
	public function setid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SeatPeer::ID;
		}

		return $this;
	} // setid()

	/**
	 * Set the value of [rowid] column.
	 * 
	 * @param      int $v new value
	 * @return     Seat The current object (for fluent API support)
	 */
	public function setrowId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rowid !== $v) {
			$this->rowid = $v;
			$this->modifiedColumns[] = SeatPeer::ROWID;
		}

		if ($this->aRow !== null && $this->aRow->getid() !== $v) {
			$this->aRow = null;
		}

		return $this;
	} // setrowId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Seat The current object (for fluent API support)
	 */
	public function setname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SeatPeer::NAME;
		}

		return $this;
	} // setname()

	/**
	 * Set the value of [number] column.
	 * 
	 * @param      string $v new value
	 * @return     Seat The current object (for fluent API support)
	 */
	public function setnumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->number !== $v) {
			$this->number = $v;
			$this->modifiedColumns[] = SeatPeer::NUMBER;
		}

		return $this;
	} // setnumber()

	/**
	 * Sets the value of the [noseat] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Seat The current object (for fluent API support)
	 */
	public function setnoSeat($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->noseat !== $v) {
			$this->noseat = $v;
			$this->modifiedColumns[] = SeatPeer::NOSEAT;
		}

		return $this;
	} // setnoSeat()

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
			$this->rowid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->number = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->noseat = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = SeatPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Seat object", $e);
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

		if ($this->aRow !== null && $this->rowid !== $this->aRow->getid()) {
			$this->aRow = null;
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
			$con = Propel::getConnection(SeatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SeatPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aRow = null;
			$this->collSeatToAvailabilitys = null;

			$this->collSeatToOrders = null;

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
			$con = Propel::getConnection(SeatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = SeatQuery::create()
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
			$con = Propel::getConnection(SeatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SeatPeer::addInstanceToPool($this);
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

			if ($this->aRow !== null) {
				if ($this->aRow->isModified() || $this->aRow->isNew()) {
					$affectedRows += $this->aRow->save($con);
				}
				$this->setRow($this->aRow);
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

			if ($this->seatToAvailabilitysScheduledForDeletion !== null) {
				if (!$this->seatToAvailabilitysScheduledForDeletion->isEmpty()) {
					SeatAvailabilityQuery::create()
						->filterByPrimaryKeys($this->seatToAvailabilitysScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->seatToAvailabilitysScheduledForDeletion = null;
				}
			}

			if ($this->collSeatToAvailabilitys !== null) {
				foreach ($this->collSeatToAvailabilitys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->seatToOrdersScheduledForDeletion !== null) {
				if (!$this->seatToOrdersScheduledForDeletion->isEmpty()) {
					OrderSeatQuery::create()
						->filterByPrimaryKeys($this->seatToOrdersScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->seatToOrdersScheduledForDeletion = null;
				}
			}

			if ($this->collSeatToOrders !== null) {
				foreach ($this->collSeatToOrders as $referrerFK) {
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

		$this->modifiedColumns[] = SeatPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . SeatPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(SeatPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(SeatPeer::ROWID)) {
			$modifiedColumns[':p' . $index++]  = '`ROWID`';
		}
		if ($this->isColumnModified(SeatPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(SeatPeer::NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`NUMBER`';
		}
		if ($this->isColumnModified(SeatPeer::NOSEAT)) {
			$modifiedColumns[':p' . $index++]  = '`NOSEAT`';
		}

		$sql = sprintf(
			'INSERT INTO `seat` (%s) VALUES (%s)',
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
					case '`ROWID`':
						$stmt->bindValue($identifier, $this->rowid, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`NUMBER`':
						$stmt->bindValue($identifier, $this->number, PDO::PARAM_STR);
						break;
					case '`NOSEAT`':
						$stmt->bindValue($identifier, (int) $this->noseat, PDO::PARAM_INT);
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

			if ($this->aRow !== null) {
				if (!$this->aRow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRow->getValidationFailures());
				}
			}


			if (($retval = SeatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSeatToAvailabilitys !== null) {
					foreach ($this->collSeatToAvailabilitys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSeatToOrders !== null) {
					foreach ($this->collSeatToOrders as $referrerFK) {
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
		$pos = SeatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getrowId();
				break;
			case 2:
				return $this->getname();
				break;
			case 3:
				return $this->getnumber();
				break;
			case 4:
				return $this->getnoSeat();
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
		if (isset($alreadyDumpedObjects['Seat'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Seat'][$this->getPrimaryKey()] = true;
		$keys = SeatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getid(),
			$keys[1] => $this->getrowId(),
			$keys[2] => $this->getname(),
			$keys[3] => $this->getnumber(),
			$keys[4] => $this->getnoSeat(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aRow) {
				$result['Row'] = $this->aRow->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collSeatToAvailabilitys) {
				$result['SeatToAvailabilitys'] = $this->collSeatToAvailabilitys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collSeatToOrders) {
				$result['SeatToOrders'] = $this->collSeatToOrders->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = SeatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setrowId($value);
				break;
			case 2:
				$this->setname($value);
				break;
			case 3:
				$this->setnumber($value);
				break;
			case 4:
				$this->setnoSeat($value);
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
		$keys = SeatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setrowId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setname($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setnumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setnoSeat($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SeatPeer::DATABASE_NAME);

		if ($this->isColumnModified(SeatPeer::ID)) $criteria->add(SeatPeer::ID, $this->id);
		if ($this->isColumnModified(SeatPeer::ROWID)) $criteria->add(SeatPeer::ROWID, $this->rowid);
		if ($this->isColumnModified(SeatPeer::NAME)) $criteria->add(SeatPeer::NAME, $this->name);
		if ($this->isColumnModified(SeatPeer::NUMBER)) $criteria->add(SeatPeer::NUMBER, $this->number);
		if ($this->isColumnModified(SeatPeer::NOSEAT)) $criteria->add(SeatPeer::NOSEAT, $this->noseat);

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
		$criteria = new Criteria(SeatPeer::DATABASE_NAME);
		$criteria->add(SeatPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Seat (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setrowId($this->getrowId());
		$copyObj->setname($this->getname());
		$copyObj->setnumber($this->getnumber());
		$copyObj->setnoSeat($this->getnoSeat());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getSeatToAvailabilitys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSeatToAvailability($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSeatToOrders() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSeatToOrder($relObj->copy($deepCopy));
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
	 * @return     Seat Clone of current object.
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
	 * @return     SeatPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SeatPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Row object.
	 *
	 * @param      Row $v
	 * @return     Seat The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRow(Row $v = null)
	{
		if ($v === null) {
			$this->setrowId(NULL);
		} else {
			$this->setrowId($v->getid());
		}

		$this->aRow = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Row object, it will not be re-added.
		if ($v !== null) {
			$v->addRowToSeat($this);
		}

		return $this;
	}


	/**
	 * Get the associated Row object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Row The associated Row object.
	 * @throws     PropelException
	 */
	public function getRow(PropelPDO $con = null)
	{
		if ($this->aRow === null && ($this->rowid !== null)) {
			$this->aRow = RowQuery::create()->findPk($this->rowid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRow->addRowToSeats($this);
			 */
		}
		return $this->aRow;
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
		if ('SeatToAvailability' == $relationName) {
			return $this->initSeatToAvailabilitys();
		}
		if ('SeatToOrder' == $relationName) {
			return $this->initSeatToOrders();
		}
	}

	/**
	 * Clears out the collSeatToAvailabilitys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSeatToAvailabilitys()
	 */
	public function clearSeatToAvailabilitys()
	{
		$this->collSeatToAvailabilitys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSeatToAvailabilitys collection.
	 *
	 * By default this just sets the collSeatToAvailabilitys collection to an empty array (like clearcollSeatToAvailabilitys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initSeatToAvailabilitys($overrideExisting = true)
	{
		if (null !== $this->collSeatToAvailabilitys && !$overrideExisting) {
			return;
		}
		$this->collSeatToAvailabilitys = new PropelObjectCollection();
		$this->collSeatToAvailabilitys->setModel('SeatAvailability');
	}

	/**
	 * Gets an array of SeatAvailability objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Seat is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SeatAvailability[] List of SeatAvailability objects
	 * @throws     PropelException
	 */
	public function getSeatToAvailabilitys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSeatToAvailabilitys || null !== $criteria) {
			if ($this->isNew() && null === $this->collSeatToAvailabilitys) {
				// return empty collection
				$this->initSeatToAvailabilitys();
			} else {
				$collSeatToAvailabilitys = SeatAvailabilityQuery::create(null, $criteria)
					->filterBySeat($this)
					->find($con);
				if (null !== $criteria) {
					return $collSeatToAvailabilitys;
				}
				$this->collSeatToAvailabilitys = $collSeatToAvailabilitys;
			}
		}
		return $this->collSeatToAvailabilitys;
	}

	/**
	 * Sets a collection of SeatToAvailability objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $seatToAvailabilitys A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setSeatToAvailabilitys(PropelCollection $seatToAvailabilitys, PropelPDO $con = null)
	{
		$this->seatToAvailabilitysScheduledForDeletion = $this->getSeatToAvailabilitys(new Criteria(), $con)->diff($seatToAvailabilitys);

		foreach ($seatToAvailabilitys as $seatToAvailability) {
			// Fix issue with collection modified by reference
			if ($seatToAvailability->isNew()) {
				$seatToAvailability->setSeat($this);
			}
			$this->addSeatToAvailability($seatToAvailability);
		}

		$this->collSeatToAvailabilitys = $seatToAvailabilitys;
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
	public function countSeatToAvailabilitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSeatToAvailabilitys || null !== $criteria) {
			if ($this->isNew() && null === $this->collSeatToAvailabilitys) {
				return 0;
			} else {
				$query = SeatAvailabilityQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySeat($this)
					->count($con);
			}
		} else {
			return count($this->collSeatToAvailabilitys);
		}
	}

	/**
	 * Method called to associate a SeatAvailability object to this object
	 * through the SeatAvailability foreign key attribute.
	 *
	 * @param      SeatAvailability $l SeatAvailability
	 * @return     Seat The current object (for fluent API support)
	 */
	public function addSeatToAvailability(SeatAvailability $l)
	{
		if ($this->collSeatToAvailabilitys === null) {
			$this->initSeatToAvailabilitys();
		}
		if (!$this->collSeatToAvailabilitys->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddSeatToAvailability($l);
		}

		return $this;
	}

	/**
	 * @param	SeatToAvailability $seatToAvailability The seatToAvailability object to add.
	 */
	protected function doAddSeatToAvailability($seatToAvailability)
	{
		$this->collSeatToAvailabilitys[]= $seatToAvailability;
		$seatToAvailability->setSeat($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Seat is new, it will return
	 * an empty collection; or if this Seat has previously
	 * been saved, it will retrieve related SeatToAvailabilitys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Seat.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SeatAvailability[] List of SeatAvailability objects
	 */
	public function getSeatToAvailabilitysJoinPerformance($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SeatAvailabilityQuery::create(null, $criteria);
		$query->joinWith('Performance', $join_behavior);

		return $this->getSeatToAvailabilitys($query, $con);
	}

	/**
	 * Clears out the collSeatToOrders collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSeatToOrders()
	 */
	public function clearSeatToOrders()
	{
		$this->collSeatToOrders = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSeatToOrders collection.
	 *
	 * By default this just sets the collSeatToOrders collection to an empty array (like clearcollSeatToOrders());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initSeatToOrders($overrideExisting = true)
	{
		if (null !== $this->collSeatToOrders && !$overrideExisting) {
			return;
		}
		$this->collSeatToOrders = new PropelObjectCollection();
		$this->collSeatToOrders->setModel('OrderSeat');
	}

	/**
	 * Gets an array of OrderSeat objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Seat is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array OrderSeat[] List of OrderSeat objects
	 * @throws     PropelException
	 */
	public function getSeatToOrders($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSeatToOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collSeatToOrders) {
				// return empty collection
				$this->initSeatToOrders();
			} else {
				$collSeatToOrders = OrderSeatQuery::create(null, $criteria)
					->filterBySeat($this)
					->find($con);
				if (null !== $criteria) {
					return $collSeatToOrders;
				}
				$this->collSeatToOrders = $collSeatToOrders;
			}
		}
		return $this->collSeatToOrders;
	}

	/**
	 * Sets a collection of SeatToOrder objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $seatToOrders A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setSeatToOrders(PropelCollection $seatToOrders, PropelPDO $con = null)
	{
		$this->seatToOrdersScheduledForDeletion = $this->getSeatToOrders(new Criteria(), $con)->diff($seatToOrders);

		foreach ($seatToOrders as $seatToOrder) {
			// Fix issue with collection modified by reference
			if ($seatToOrder->isNew()) {
				$seatToOrder->setSeat($this);
			}
			$this->addSeatToOrder($seatToOrder);
		}

		$this->collSeatToOrders = $seatToOrders;
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
	public function countSeatToOrders(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSeatToOrders || null !== $criteria) {
			if ($this->isNew() && null === $this->collSeatToOrders) {
				return 0;
			} else {
				$query = OrderSeatQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySeat($this)
					->count($con);
			}
		} else {
			return count($this->collSeatToOrders);
		}
	}

	/**
	 * Method called to associate a OrderSeat object to this object
	 * through the OrderSeat foreign key attribute.
	 *
	 * @param      OrderSeat $l OrderSeat
	 * @return     Seat The current object (for fluent API support)
	 */
	public function addSeatToOrder(OrderSeat $l)
	{
		if ($this->collSeatToOrders === null) {
			$this->initSeatToOrders();
		}
		if (!$this->collSeatToOrders->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddSeatToOrder($l);
		}

		return $this;
	}

	/**
	 * @param	SeatToOrder $seatToOrder The seatToOrder object to add.
	 */
	protected function doAddSeatToOrder($seatToOrder)
	{
		$this->collSeatToOrders[]= $seatToOrder;
		$seatToOrder->setSeat($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Seat is new, it will return
	 * an empty collection; or if this Seat has previously
	 * been saved, it will retrieve related SeatToOrders from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Seat.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array OrderSeat[] List of OrderSeat objects
	 */
	public function getSeatToOrdersJoinOrder($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = OrderSeatQuery::create(null, $criteria);
		$query->joinWith('Order', $join_behavior);

		return $this->getSeatToOrders($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->rowid = null;
		$this->name = null;
		$this->number = null;
		$this->noseat = null;
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
			if ($this->collSeatToAvailabilitys) {
				foreach ($this->collSeatToAvailabilitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSeatToOrders) {
				foreach ($this->collSeatToOrders as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collSeatToAvailabilitys instanceof PropelCollection) {
			$this->collSeatToAvailabilitys->clearIterator();
		}
		$this->collSeatToAvailabilitys = null;
		if ($this->collSeatToOrders instanceof PropelCollection) {
			$this->collSeatToOrders->clearIterator();
		}
		$this->collSeatToOrders = null;
		$this->aRow = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(SeatPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseSeat

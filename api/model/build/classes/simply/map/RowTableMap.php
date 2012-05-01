<?php



/**
 * This class defines the structure of the 'row' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.simply.map
 */
class RowTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.RowTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('row');
		$this->setPhpName('Row');
		$this->setClassname('Row');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addForeignKey('VENUEID', 'venueId', 'INTEGER', 'venue', 'ID', false, null, null);
		$this->addColumn('NAME', 'name', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Venue', 'Venue', RelationMap::MANY_TO_ONE, array('venueId' => 'id', ), null, null);
		$this->addRelation('RowToSeat', 'Seat', RelationMap::ONE_TO_MANY, array('id' => 'rowId', ), null, null, 'RowToSeats');
	} // buildRelations()

} // RowTableMap

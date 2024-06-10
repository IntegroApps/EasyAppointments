<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Service-Categories model.
 *
 * Handles all the database operations of the service-category resource.
 *
 * @package Models
 */
class Cust_identifiers_model extends EA_Model
{
    /**
     * @var array
     */
    protected array $casts = [
        'id' => 'integer',
        'id_roles' => 'integer',
    ];

    /**
     * @var array
     */
    protected array $api_resource = [
        'id' => 'id',
        'identifier' => 'identifier',
        'appointmentId' => 'appointment_id',
    ];

    /**
     * Save (insert or update) a identifier.
     *
     * @param array $service_category Associative array with the service-category data.
     *
     * @return int Returns the service-category ID.
     *
     * @throws InvalidArgumentException
     */
    public function save(array $identifier): int
    {
        if (empty($identifier['id'])) {
            return $this->insert($identifier);
        }
    }

    /**
     * Insert a new identifier into the database.
     *
     * @param array $identifier Associative array with the identifier data.
     *
     * @return int Returns the identifier ID.
     *
     * @throws RuntimeException
     */
    protected function insert(array $identifier): int
    {
        if (!$this->db->insert('cust_identifiers', $identifier)) {
            throw new RuntimeException('Could not insert identifier.');
        }

        return $this->db->insert_id();
    }

    /**
     * Get the query builder interface, configured for use with the cust_identifiers table.
     *
     * @return CI_DB_query_builder
     */
    public function query(): CI_DB_query_builder
    {
        return $this->db->from('cust_identifiers');
    }

   
    public function get(
string $identifier
    ) {

        // $identifiers = $this->db->get('cust_identifiers', $limit, $offset)->result_array();
        $result = $this->db->query("SELECT eci.identifier FROM ea_cust_identifiers eci WHERE eci.identifier = ?", $identifier)->result_array();

        return $result;
    }
}

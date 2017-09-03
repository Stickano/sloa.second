<?php
    # This will hold all the CRUD methods

class crud{

    private $conn;
    public function __construct(connection $conn){
        $this->conn = $conn;
    }

    /**
     * Recieves results from the DB
     * @param  string $data    Which rows to select
     * @param  string $from    From which table
     * @param  string $where   Result criteria
     * @param  string $orderBy Which row to order by
     * @param  string $order   ASC/DESC
     * @param  int    $limit   Result limie
     * @return array           Return results in an array
     */
    public function recieve($data, $from, $where=null, $orderBy=null, $order=null, $limit=null){

        # Secure the inputs
        $data = mysqli_real_escape_string($this->conn, $data);
        $from = mysqli_real_escape_string($this->conn, $from);
        $orderBy = mysqli_real_escape_string($this->conn, $orderBy);

        # Build the WHERE clause
        if($where != null){
            $where = mysqli_real_escape_string($this->conn, $where);
            $where = 'WHERE '.$where;
        }

        # Format the SQL order value
        if(strtolower($order)=='asc' || strtolower($order)=='desc')
            $order = "ORDER BY ".$orderBy." ".strtoupper($order);
        else
            $order = null;
        
        # Format the SQL limit value
        if(is_int($limit) && $limit>0)
            $limit = "LIMIT ".$limit;
        else
            $limit = null;

        # Build and run the query
        $sql = "SELECT ".$data." FROM ".$from." ".$where." ".$order." ".$limit;
        $query = $this->conn->query($sql);

        # Return the SQL error if any
        if(!$query)
            return $this->conn->error;

        # Return the result(s)
        $result = null;
        $br = 0;
        if($query->num_rows > 1){
            $result = array();
            while($row = $query->fetch_assoc()){
                $result[] = $row;
            }
        }elseif($query->num_rows > 0)
            $result = $query->fetch_assoc();

        return $result;
    }

    /**
     * Insert data to the db
     * @param  string $table  table to insert data
     * @param  string $rows   which rows will be affected
     * @param  string $values the values of the insertion
     * @return bool/string    True on succes/ SQL error on fail
     */
    public function create($table, $rows, $values){

        # Secure the inputs
        $table = mysqli_real_escape_string($this->conn, $table);
        $rows = mysqli_real_escape_string($this->conn, $rows);
        $values = mysqli_real_escape_string($this->conn, $values);

        # Build and run query
        $sql = "INSERT INTO ".$table." (".$rows.") VALUES (".$values.")";
        $query = $this->conn->query($sql);

        # Return the SQL error if any
        if(!$query)
            return $this->conn->error;

        return true;
    }

    /**
     * Update database row
     * @param  string $table update table
     * @param  string $data  with this data
     * @param  string $where at this location
     * @return bool/string   True on success/ SQL error on fail
     */
    public function update($table, $data, $where) {

        # Secure inputs
        $table = mysqli_real_escape_string($this->conn, $table);
        $data = mysqli_real_escape_string($this->conn, $data);
        $where = mysqli_real_escape_string($this->conn, $where);

        # Build and run query
        $sql = "UPDATE ".$table." SET ".$data." WHERE".$where."";
        $query = $this->conn->query($sql);

        # Return the SQL error if any
        if(!$query)
            return $this->conn->error;

        return true;
    }

    /**
     * Delete from database
     * @param  string $table delete from this table
     * @param  string $where at this position
     * @return bool/string   True on succes/ SQL error on fail
     */
    public function delete($table, $where) {

        # Secure the inputs
        $table = mysqli_real_escape_string($this->conn, $table);
        $where = mysqli_real_escape_string($this->conn, $where);

        # Build and run query
        $sql = "DELETE FROM ".$table." WHERE ".$where."";
        $this->conn->query($sql);

        # Return the SQL error if any
        if(!$query)
            return $this->conn->error;

        return true;
    }
}

?>
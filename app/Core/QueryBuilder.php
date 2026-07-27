<?php

namespace Core;

use Core\DB;

class QueryBuilder{

    protected $pdo;

    protected $selectLine  = "";
    protected $joinLine    = "";
    protected $whereLine   = "";
    protected $groupByLine = "";

    protected $sql = "";

    protected $bindings = [];

    public function __construct()
    {
        $this->pdo = new DB();
        $this->pdo = $this->pdo->connect();
    }

    //                  SELECT

    public function selectAll($table)
    {
        $this->selectLine = " SELECT * FROM {$table} ";
        return $this;
    }

    public function select($table, $columns)
    {

        $selectedFields = [];
        foreach ($columns as $key => $value) {
            $selectedFields[] = is_int($key) ? $value : "$key AS $value";
        }

        $this->selectLine = " SELECT " . implode(", ", $selectedFields) . " FROM " . $table ;
        return $this;
    }


    public function count($table, $column = '*')
    {
        $this->selectLine = " SELECT COUNT({$column}) FROM {$table} ";
        return $this;
    }


            //              JOIN, WHERE, GROUP BY

    public function WHERE($columns, $values, $operators = [])
    {
        $allowedOperators = ['=', 'LIKE', '>', '<', '>=', '<=', '<>', 'NOT LIKE'];
        $rand = mt_rand(0, 222);
        $conditions = [];
        for ($i = 0; $i < count($columns); $i++) { 
            
            if (!in_array($operators[$i], $allowedOperators)) {
                $operators[$i] = '=';
            }

            $conditions[] = $columns[$i] . " " . $operators[$i] . " :rand" . $rand . str_replace('.', '_', $columns[$i]) . "";
            $this->bindings["rand" . $rand . str_replace('.', '_', $columns[$i])] = $values[$i];
        }
        $this->whereLine = " WHERE " . implode(" AND ", $conditions) . " ";
        return $this;
    }

    public function groupBy($columns)
    {
        $this->groupByLine = " GROUP BY " . implode("," , $columns) . " ";
        return $this;
    }

    // الجوين مسروقة من صالح
    public function join($table, $columnToJoin, $columnToJoinWith, $type = "", $outer = false)
    {
        $type = match ($type) {
            "left" => " LEFT",
            "right" => " RIGHT",
            "full" => " FULL ",
            default => " INNER ",
        };
        if($outer) $type .= " OUTER ";
        $this->joinLine .= $type . " JOIN " . $table . " ON " . $columnToJoinWith . " = " . $columnToJoin . " ";
        return $this;
    }


                        //          CRUD


    public function GET()
    {
        $this->sql  = $this->selectLine;
        $this->sql .= $this->joinLine;
        $this->sql .= $this->whereLine;
        $this->sql .= $this->groupByLine;

        return $this;
    }

    public function create($table, $columns, $values)   // X whereLine
    {
        $rand = mt_rand(0, 222);
        $this->sql = "INSERT INTO ". $table . " (" . implode(",", $columns) . ") VALUES (:rand".$rand . str_replace('.', '_', (implode(",:rand".$rand, $columns))) . "); " ;
        
        for ($i=0; $i < count($columns); $i++) {
            $this->bindings["rand" . $rand . str_replace('.', '_', $columns[$i])] = $values[$i];
        }
        

        return $this;
    }


    public function UPDATE($table, $columns, $values)   // whereLine
    {
        $rand = mt_rand(0, 222);
        $seter = [];

        $this->sql = "UPDATE " . $table . " SET ";

        for ($i=0; $i < count($columns) ; $i++) {
            $seter[] = $columns[$i] . "= :rand" . $rand . str_replace('.', '_', $columns[$i]) ." " ;
            $this->bindings["rand" . $rand . str_replace('.', '_', $columns[$i])] = $values[$i];
        }

        $this->sql .= implode(",", $seter);
        $this->sql .= " ";
        $this->sql .= $this->whereLine;
        
        return $this;
    }

    public function DELETE($table)
    {

        $this->sql = "DELETE FROM " . $table . " ";

        $this->sql .= $this->joinLine;
        $this->sql .= $this->whereLine;

        return $this;
    }

            //          EXECUTE

    public function execute()
    {

        $query = $this->sql;
                  
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($this->bindings);

        $this->selectLine = $this->joinLine = $this->whereLine = $this->groupByLine = $this->sql = "";
        $this->bindings = [];

        if (str_starts_with(trim(strtoupper($query)), 'SELECT')) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $stmt->rowCount();

    }

}
// احا

/*
$builder = new QueryBuilder();

$users = $builder->select('users', ['id', 'name' => 'username'])
                 ->join('orders', 'users.id', 'orders.user_id', 'left')
                 ->WHERE(['users.status'], ['active'], ['='])
                 ->GET()
                 ->execute();


$affectedRows = $builder->WHERE(['id'], [10], ['='])
                        ->UPDATE('users', ['name', 'status'], ['Abdelrahman', 'active'])
                        ->execute();


$allUsers = $builder->selectAll('users')
                    ->GET()
                    ->execute();

$activeUsers = $builder->select('users', ['id', 'email', 'name' => 'username'])
                       ->WHERE(['status'], ['active'], ['='])
                       ->GET()
                       ->execute();


$newUserId = $builder->create(
    'users', 
    ['name', 'email', 'password', 'status'], 
    ['Mohamed', 'mohamed@email.com', 'secret123', 'active']
)->execute();

*/

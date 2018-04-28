<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/4/26
 * Time: 15:55
 */

/**
 * Class DBC
 * @var $linkType bool
 * @var $host string
 * @var $username string
 * @var $passwd string
 * @var $dbname string
 * @var $link PDO|mysqli
 * @car $error int
 * @method
 */

class DBC  {

    private
        $linkType,// 0 => mysqli, 1 => pdo
        $host,
        $username,
        $passwd,
        $dbname,
        $link,
        $error;

    function __construct(int $linkType = 0, string $host = '127.0.0.1', string $username = 'root', string $passwd = '', string $dbname = '')  {

        if ($linkType == 0)
            $this->linkType = 0;
        else
            $this->linkType = 1;
        $this->dbType = 'MySQL';
        $this->host = $host;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->dbname = $dbname;
    }

    public function connect() {

        $a = func_get_args();
        $i = func_num_args();

        if(method_exists($this, $f = 'connect'.$i))
            call_user_func_array(array($this, $f), $a);

        return 0;
    }

    private function connect0() {

        if($this->linkType == 0)
            $this->link = new mysqli($this->host, $this->username, $this->passwd, $this->dbname);
        else
            $this->link = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->passwd);

        return 0;
    }
    
    private function connect1(string $DBType) {
        
        if($this->linkType == 0)
            return $this->error = 23301;
        else
            $this->link = new PDO($DBType.':host='.$this->host.';dbname='.$this->dbname, $this->username, $this->passwd);

        return 0;
    }

    public function errorCode() {

        return $this->error;
    }

    public function query(string $sql) {

        if($this->linkType == 0) {

            $this->link->query($sql);
        } else {

            $this->link->query($sql);
        }
    }

    public function select(array $columns, string $tableName, string $where = NULL) {

        $column = '';
        foreach ($columns as $i) {

            if ($columns[0] !== $i) $column .= ',';
            $column .= $i;
        }
        if ($where == NULL) {

            $this->query('SELECT '.$column.' FROM '.$tableName.';');
        } else {

            $this->query('SELECT '.$column.' FROM '.$tableName.' WHERE '.$where.';');
        }
    }

    public function update(string $tableName, array $values, string $where) {

         $sql = 'UPDATE '.$tableName.' SET ';
        foreach ($columns as $key => $val) {

            if ($columns[0] !== $i) $column .= ',';
            $column .= $i;
        }
    }

    public function insert() {}

    public function delete() {}



    public function prepare($sql) {

    }

    public function bindParam() {

    }

    public function execute() {}

    public function fetch() {}

    public function fetch_all() {}

    public function fetch_assoc() {}




}

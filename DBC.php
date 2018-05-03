<?php
/**
 * Database Controller (DBC)
 *
 * 这是一个用来进行连接数据库操作的类，通过封装mysqli对象和PDO对象来通过两种不同的方式操作数据库
 * mysqli 模式下只能操作MySQL数据库
 * PDO模式下可以对多种类型的数据库进行操作
 * 所有代替完整SQL语句的方法参数都按照原SQL语句中的顺序出现
 *
 * @var bool linkType 0 => mysqli, 1 => pdo
 * @var string host
 * @var string username
 * @var string passwd
 * @var string dbname
 * @var PDO|mysqli link
 * @var int error
 * @var mysqli_stmt|PDOStatement statement
 * @var
 */

class DBCResult
{

    const
        DBC_FETCH_NUM = 11,
        DBC_FETCH_ASSOC = 12,
        DBC_FETCH_OBJ = 13,
        DBC_FETCH_ARRAY = 14, // Both num and associate.
        DBC_FETCH_BOTH = 15,
        DBC_ERROR_FETCH_ATTR = 101;

    private
        $linkType,
        $main,
        $error = 0;

    public function __construct(int $linkType,  $obj) {

        $this->linkType = $linkType;
        $this->main = $obj;
    }

    public function fetch(int $attr = 11) {

        if ($this->linkType == 0) {

            switch ($attr) {

                case 11:
                    return $this->main->fetch_row();
                case 12:
                    return $this->main->fetch_assoc();
                case 13:
                    return $this->main->fetch_object();
                case 14:
                    return $this->main->fetch_array();
                default:
                    return $this->error = 101;
            }
        }
    }

    public function fetch_all(int $attr = 11) {

        if ($this->linkType == 0) {

            switch ($attr) {

                case 11:
                    return $this->main->fetch_all(MYSQLI_NUM);
                case 12:
                    return $this->main->fetch_all(MYSQLI_ASSOC);
                case 14:
                    return $this->main->fetch_all(MYSQLI_BOTH);
                default:
                    return $this->error = 101;
            }
        }
    }

    public function fieldCount() {

        if ($this->linkType == 0) {

            return $this->main->field_count;
        }
    }

}

class DBC {

    private
        $linkType,
        $dbType,
        $host,
        $username,
        $passwd,
        $dbname,
        $link,
        $arg_num,
        $error = 0;

    const
        DBC_CREATE_DB = 101,
        DBC_CREATE_TABLE = 102,
        DBC_ERROR_LINKTYPE_MATCH = 23301;

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

    public function query(string $sql, string $index = NULL) {

        if ($this->linkType == 0) {

            if ($index == NULL)
                return new DBCResult($this->linkType, $this->link->query($sql));
            return new DBCResult($this->linkType, $this->link->query($sql));
        } else {

            if ($index == NULL)
                return NEW DBCResult($this->linkType, $this->link->query($sql));
            return new DBCResult($this->linkType, $this->link->query($sql));
        }
    }

    public function select(string $tableName, array $columns, string $param = NULL, string $index = NULL) {

        $column = '';
        foreach ($columns as $i) {

            $column .= ($columns[0] != $i) ? ','.$i : $i;
        }
        if ($param == NULL) {

            $sql = 'SELECT '.$column.' FROM '.$tableName.';';
        } else {

            $sql = 'SELECT '.$column.' FROM '.$tableName.' WHERE '.$param.';';
        }
        return $this->query($sql, $index);
    }

    public function update(string $tableName, array $values, string $param) {

         $column = '';
         $key0 = key($values);
        foreach ($values as $k => $v) {

            $column .= ($values[$key0] === $v) ? $k.'='.$v : ','.$k.'='.$v;
        }
        if ($param == NULL) {

            return NULL;
        } else {

            $sql = 'UPDATE '.$tableName.' SET '.$column.' WHERE '.$param;
            $this->query($sql);
        }
    }

    public function insert(string $tableName, array $values) {

        $col = '';
        $val = '';
        $key0 = key($values);
        foreach ($values as $k => $v) {

            $col .= ($values[$key0] === $v) ? '('.$k : ','.$k;
            $val .= ($values[$key0] === $v) ? '('.$v : ','.$v;
        }
        $col .= ')';
        $val .= ')';
        $sql = "INSERT INTO $tableName $col VALUES $val;";
        $this->query($sql);
    }

    public function delete(string $tableName, string $param) {

        if ($param == NULL) {

            return 0;
        } else {

            $sql = "DELETE FROM $tableName WHERE $param";
        }
        $this->query($sql);
    }


    public function prepare($sql) {

        $this->statement = $this->link->prepare($sql);
    }

    public function bindParam() {

        $a = func_get_args();
        $i = func_num_args();

        if ($this->linkType == 0) {

            call_user_func_array(array($this->statement, 'bind_param'), $a);
            $this->arg_num = $i - 1;
        } elseif ($this->linkType == 1) {

            call_user_func_array(array($this->statement, 'bindParam'), $a);
        }
    }

    public function execute() {

        if ($this->linkType == 0) {

            $this->statement->execute();
        } elseif ($this->linkType == 1) {

            $this->statement->execute();
        }
    }



    public function join(array $columns, string $table1, string $table2, int $joinType, string $param) {

        $column = '';
        foreach ($columns as $col) {

            $column .= ($col === $column[0]) ? $col : ','.$col;
        }
        $sql = 'SELECT '.$column.' FROM '.$table1.' '.$joinType.' JOIN '.$table2.' WHERE '.$param.';';
        $this->query($sql);
    }

    public function createDB(string $DBname) {

        $sql = 'CREATE DATABASE '.$DBname.';';
        $this->query($sql);
    }

    public function createTable(string $tableName, array $columns) {

        $sql = 'CREATE TABLE '.$tableName;
        foreach ($columns as $column) {

            $sql .= ($column === $columns[0]) ? '('.$column : ','.$column;
        }
        $sql .= ');';

        $this->query($sql);
    }

//    public function

}

$a = new DBC();
$cols = array(1, 'abc');
//$a->update('tableName', $cols, '1=1');
//$a->select($cols, 'tableName', '1=1');
//$a->insert('table1', $cols);
//$a->delete('table1', '1=1');
//$b = new mysqli('localhost', 'test', 'test', 'runoob_test');
//$c = $b->query('select * from websites');
//print_r($c->fetch_row());

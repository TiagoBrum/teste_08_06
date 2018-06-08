
<?php

class MyUserClass
{
    private $dbconn;

    public function __construct()
    {
        $this->dbconn = new DatabaseConnection('localhost', 'user', 'password');
    }

    public function __destruct()
    {
        $this->dbconn->close();
    }

    public function getUserList()
    {
        try {
            $results = $this->dbconn->query('select name from user order by name');

            return $results;
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
<?php

class Database
{

    private string $host;

    private string $name;

    private string $user;

    private string $password;

    /**
     * @param string $host
     * @param string $name
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $name, string $user, string $password)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    public function connect() : PDO {
        $pdo = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->password);
        return $pdo;
    }


}
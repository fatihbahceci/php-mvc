<?php

class db
{
    /**
     * Veritabanını nesnesini tutar
     * @var void
     */
    public $db;

    /**
     * Veritabanı nesnesini oluşturur
     */
    public function __construct()
    {
        $this->db = new PDO(_db_connection_string, _db_user_name, _db_password);
    }

    /**
     * Tek satırlık veri döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetch($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetch();
    }

    /**
     * Birden fazla satır döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetchObject($query, string $objectClass, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        $sth->setFetchMode(PDO::FETCH_CLASS, $objectClass);
        return $sth->fetch();
    }

    /**
     * Birden fazla satır döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetchAll($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    /**
     * Birden fazla satır döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetchAllObject($query, string $objectClass, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $objectClass);
    }

    /**
     * Sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function query($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetch();
    }

    public function querySingleField($query, array $params = [])
    {
        return $this->query($query, $params)[0];
    }
    public function exec($query, array $params = [], bool $returnLastInsertId = false)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $i = $stmt->errorInfo();
        if ($i != null && count($i) > 0 && !($i[0] == '0000')) {
            //Array ( [0] => 00000 [1] => [2] => )
            return $i;
        }
        if (!$returnLastInsertId) {
            return null;
        } else {
            return $this->db->lastInsertId();
        }
    }
}

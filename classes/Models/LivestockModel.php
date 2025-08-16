<?php
namespace Models;

class LivestockModel extends Dbh {

    public function getBatchesByLivestockID($livestockID, $companyID) {
        try {
            $sql = "SELECT
                b.*,
                l.livestockName,
                l.category,
                (b.quantity - COALESCE(SUM(bl.quantity), 0) - COALESCE(SUM(bs.quantity), 0)) AS current_quantity
            FROM
                batch b
            LEFT JOIN 
                livestock l ON b.livestockID = l.id
            LEFT JOIN 
                batch_losses bl ON b.id = bl.batchID
            LEFT JOIN 
                batch_sales bs ON b.id = bs.batchID
            WHERE
                b.livestockID = ? 
            AND 
                b.companyID = ?
            GROUP BY 
                b.id
            ";

            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$livestockID, $companyID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('BatchModel getBatchesByCompany error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return [];
        }
    }

    public function addLivestock($data, $companyID, $userID) {
        try {
            $sql = "INSERT INTO livestock (livestockName, category, companyID, addedBy) VALUES (?, ?, ?, ?)";
            $stmt = $this->con()->prepare($sql);
            return $stmt->execute([
                $data['livestockName'],
                $data['category'],
                $companyID,
                $userID,
            ]);
        } catch (\PDOException $e) {
            error_log('LivestockModel add error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/livestock_errors.log');
            return false;
        }
    }

}
                
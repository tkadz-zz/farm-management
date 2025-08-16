<?php
namespace Models;

class BatchModel extends Dbh {

    

    public function getBatchesByBatchIDandCompanyID($batchID, $companyID) {
        try {
            $sql = "SELECT 
            b.*,
            l.livestockName,
            COALESCE(bl.loss_quantity, 0) AS loss_quantity,
            COALESCE(bs.sale_quantity, 0) AS sale_quantity,
            COALESCE(bl.estimated_loss, 0) AS estimated_loss,
            COALESCE(bs.total_revenue, 0) AS total_revenue
        FROM batch b
        LEFT JOIN livestock l 
            ON b.livestockID = l.id
        LEFT JOIN (
            SELECT batchID, 
                   SUM(quantity) AS loss_quantity, 
                   SUM(estimatedLoss) AS estimated_loss
            FROM batch_losses
            GROUP BY batchID
        ) bl ON b.id = bl.batchID
        LEFT JOIN (
            SELECT batchID, 
                   SUM(quantity) AS sale_quantity, 
                   SUM(totalPrice) AS total_revenue
            FROM batch_sales
            GROUP BY batchID
        ) bs ON b.id = bs.batchID
        WHERE 
            b.id = ?
        AND 
            b.companyID = ?
        ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$batchID, $companyID]);
        return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('BatchModel getBatchesByCompany error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return [];
        }
    }


    public function getBatchSalesByID($batchID) {
        try {
            $sql = "SELECT 
            bs .*
            FROM 
                batch_sales bs
            WHERE 
                bs.batchID = ?
            ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$batchID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('BatchModel getBatchByID error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return null;
        }
    }

    public function getBatchLossesByBatchID($batchID) {
        try {
            $sql = "SELECT 
            bl.*
            FROM 
                batch_losses bl
            WHERE 
                bl.batchID = ?
            ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$batchID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('BatchModel getBatchLossesByID error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return null;
        }
    }

    public function getBatchHealthRecordsByBatchID($batchID) {
        try {
            $sql = "SELECT 
            bhr.*
            FROM 
                batch_health_records bhr
            WHERE 
                bhr.batchID = ?
            ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$batchID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('BatchModel getBatchLossesByID error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return null;
        }
    }

    public function getGrowthLogsByBatchID($batchID)
    {
        try {
            $sql = "SELECT date, averageWeight, notes
                    FROM batch_growth_logs
                    WHERE batchID = ?
                    ORDER BY date ASC";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$batchID]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log('GrowthLogModel getGrowthLogsByBatch error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/growth_logs_errors.log');
            return [];
        }
    }


    public function addbatch($batchData, $companyID, $userID) {
        try {
            $sql = "INSERT INTO batch (companyID, livestockID, batchName, purchaseDate, source, costPerUnit, totalCost, addedBy, notes, expected_at, quantity, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            return $stmt->execute([
                $companyID,
                $batchData['livestockID'],
                $batchData['batchName'],
                $batchData['purchaseDate'],
                $batchData['purchasedFrom'],
                $batchData['costPerUnit'],
                $batchData['totalCost'],
                $userID,
                $batchData['notes'],
                $batchData['expected_at'],
                $batchData['quantity'],
                $batchData['status']
            ]);
        } catch (\PDOException $e) {
            error_log('BatchModel add error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return false;
        }
    }

    public function addSale($saleData, $userID) {
        $totalPrice = $saleData['quantity'] * $saleData['unitPrice'];
        try {
            $sql = "INSERT INTO batch_sales (batchID, quantity, unitPrice, totalPrice, buyerName, date, notes, addedBy) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            return $stmt->execute([
                $saleData['batchID'],
                $saleData['quantity'],
                $saleData['unitPrice'],
                $totalPrice,
                $saleData['buyerName'],
                $saleData['soldOn'],
                $saleData['notes'],
                $userID
            ]);
        } catch (\PDOException $e) {
            error_log('BatchModel addSale error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return false;
        }
    }

    public function addLoss($data, $userID){
        try {
            $sql = "INSERT INTO batch_losses (batchID, quantity, unitPrice, estimatedLoss, reason, date, notes, addedBy) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            $totalPrice = $data['quantity'] * $data['unitPrice'];
            return $stmt->execute([
                $data['batchID'],
                $data['quantity'],
                $data['unitPrice'],
                $totalPrice,
                $data['reason'],
                $data['dateIncurred'],
                $data['notes'],
                $userID
            ]);
        } catch (\PDOException $e) {
            error_log('BatchModel addLoss error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return false;
        }
    }

    public function addHealthRecord($data, $userID) {
        try {
            $sql = "INSERT INTO batch_health_records (batchID, type, costs, date, notes, addedBy) VALUES (?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            return $stmt->execute([
                $data['batchID'],
                $data['type'],
                $data['estimated_costs'],
                $data['dateRecorded'],
                $data['notes'],
                $userID
            ]);
        } catch (\PDOException $e) {
            error_log('BatchModel addHealthRecord error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return false;
        }
    }

    public function addGrowthLog($data, $userID) {
        try {
            $sql = "INSERT INTO batch_growth_logs (batchID, averageWeight, date, notes, addedBy) VALUES (?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            return $stmt->execute([
                $data['batchID'],
                $data['averageWeight'],
                $data['dateRecorded'],
                $data['notes'],
                $userID
            ]);
        } catch (\PDOException $e) {
            error_log('BatchModel addGrowthLog error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/batch_errors.log');
            return false;
        }
    }
}
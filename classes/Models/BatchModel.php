<?php
namespace Models;

class BatchModel extends Dbh {

    public function getBatchesByBatchIDandCompanyID($batchID, $companyID) {
        try {
            $sql = "SELECT 
                b.*, 
                l.livestockName,
                COALESCE(SUM(bl.quantity), 0) AS loss_quantity,
                COALESCE(SUM(bs.quantity), 0) AS sale_quantity,
                COALESCE(SUM(bl.estimatedLoss), 0) AS estimated_loss,
                COALESCE(SUM(bs.totalPrice), 0) AS total_revenue
            FROM 
                batch b
            LEFT JOIN
                livestock l  ON b.livestockID = l.id
            LEFT JOIN batch_losses bl ON b.id = bl.batchID

            LEFT JOIN batch_sales bs ON b.id = bs.batchID

            WHERE 
                b.id = ?
            AND 
                b.companyID = ?";
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
}
<?php
namespace Models;

class DashboardModel extends Dbh {

    public function getDashboardData($companyID) {
        try {
            $sql = "SELECT 
            b.*, 
            l.livestockName,
            COALESCE(SUM(bl.estimatedLoss), 0) AS total_loss_value,
            COALESCE(SUM(bs.totalPrice), 0) AS total_revenue,
            COALESCE(SUM(bl.quantity), 0) AS total_losses,
            COALESCE(SUM(bs.quantity), 0) AS total_sales,
            (b.quantity - COALESCE(SUM(bl.quantity), 0) - COALESCE(SUM(bs.quantity), 0)) AS current_quantity
        FROM 
            batch b
        INNER JOIN 
            livestock l ON b.livestockID = l.id
        LEFT JOIN 
            batch_losses bl ON b.id = bl.batchID
        LEFT JOIN 
            batch_sales bs ON b.id = bs.batchID
        WHERE 
            b.companyID = ? AND b.status = 'active'
        GROUP BY 
            b.id
        ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$companyID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('DashboardModel getDashboardData error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/dashboard_errors.log');
            return [];
        }
    }

    public function getLivestock(){
        try {
            $sql = "SELECT 
            l.id,
            l.livestockName,
            COUNT(b.id) AS activeBatchCount
            FROM 
                livestock l
            LEFT JOIN 
                batch b 
            ON l.id = b.livestockID 
            AND b.status = 'active'
            GROUP BY 
                l.id, l.livestockName
            ORDER BY 
                l.livestockName ASC;
            ";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('DashboardModel getLivestock error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/dashboard_errors.log');
            return [];
        }
    }


    
}

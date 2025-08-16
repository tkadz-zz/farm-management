<?php
namespace Models;

class DashboardModel extends Dbh {

    public function getDashboardData($companyID) {
        try {
            $sql = "SELECT 
            b.*, 
            l.livestockName,
            l.category,
            COALESCE(bl.total_loss_value, 0) AS total_loss_value,
            COALESCE(bs.total_revenue, 0) AS total_revenue,
            COALESCE(bl.total_losses, 0) AS total_losses,
            COALESCE(bs.total_sales, 0) AS total_sales,
            (b.quantity 
                - COALESCE(bl.total_losses, 0) 
                - COALESCE(bs.total_sales, 0)
            ) AS current_quantity
        FROM 
            batch b
        LEFT JOIN 
            livestock l ON b.livestockID = l.id
        LEFT JOIN (
            SELECT 
                batchID, 
                SUM(estimatedLoss) AS total_loss_value,
                SUM(quantity) AS total_losses
            FROM 
                batch_losses
            GROUP BY batchID
        ) bl ON b.id = bl.batchID
        LEFT JOIN (
            SELECT 
                batchID, 
                SUM(totalPrice) AS total_revenue,
                SUM(quantity) AS total_sales
            FROM 
                batch_sales
            GROUP BY batchID
        ) bs ON b.id = bs.batchID
        WHERE 
            b.companyID = ? 
            AND b.status = 'active'
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

    public function getLivestock($companyID) {
        try {
            $sql = "
                SELECT 
                    l.id,
                    l.livestockName,
                    l.category,
                    COUNT(b.id) AS activeBatchCount
                FROM 
                    livestock l
                LEFT JOIN 
                    batch b 
                    ON l.id = b.livestockID 
                    AND b.status = 'active'
                WHERE 
                    l.companyID = ?
                GROUP BY 
                    l.id, l.livestockName
                ORDER BY 
                    l.livestockName ASC
            ";

            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$companyID]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('DashboardModel getLivestock error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/dashboard_errors.log');
            return [];
        }
    }

    


    
}

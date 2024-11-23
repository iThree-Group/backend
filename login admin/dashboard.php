<?php
include 'config.php';

// Query untuk total sampah
$query_total_sampah = "SELECT SUM(berat_kg) AS total_sampah FROM sampah";
$result_total_sampah = $conn->query($query_total_sampah);
$total_sampah = $result_total_sampah->fetch_assoc()['total_sampah'] ?? 0;

// Query untuk pengantar aktif
$query_pengantar_aktif = "SELECT COUNT(*) AS pengantar_aktif FROM users WHERE status_aktif = 1";
$result_pengantar_aktif = $conn->query($query_pengantar_aktif);
$pengantar_aktif = $result_pengantar_aktif->fetch_assoc()['pengantar_aktif'] ?? 0;

// Query untuk total user aktif
$query_total_user_aktif = "SELECT COUNT(*) AS total_user_aktif FROM users WHERE status_aktif = 1";
$result_total_user_aktif = $conn->query($query_total_user_aktif);
$total_user_aktif = $result_total_user_aktif->fetch_assoc()['total_user_aktif'] ?? 0;

// Query untuk total poin diberikan
$query_total_poin = "SELECT SUM(poin) AS total_poin FROM users";
$result_total_poin = $conn->query($query_total_poin);
$total_poin = $result_total_poin->fetch_assoc()['total_poin'] ?? 0;

// Query aktivitas terbaru
$query_aktivitas = "SELECT nama, keterangan, status FROM aktivitas ORDER BY tanggal DESC LIMIT 5";
$result_aktivitas = $conn->query($query_aktivitas);
?>



// penghubung php Total Sampah Diterima
                       
    <p><?php echo number_format($total_sampah, 2); ?> Kg</p>
           
// penghubung php Pengantar Aktif

   <p><?php echo $pengantar_aktif; ?> Orang</p>
            
// penghubung php Total User Aktif

    <p><?php echo $total_user_aktif; ?> User</p>
            
// penghubung php Total Poin Diberikan

    <p><?php echo number_format($total_poin); ?> Poin</p>
        
// penghubung php Aktivitas Terbaru
                
    <tbody>
        <?php while ($row = $result_aktivitas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td>
                    <span class="badge bg-<?php echo ($row['status'] == 'Selesai') ? 'success' : 'warning'; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
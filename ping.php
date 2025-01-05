<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Status Dashboard</title>
    <!-- Link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .status-box {
            width: 150px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            margin: 10px;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .status-up {
            background-color: #28a745; /* Verde */
        }
        .status-down {
            background-color: #dc3545; /* Vermelho */
        }
    </style>
</head>

<body>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard IP Status </h1>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            $page = $_SERVER['PHP_SELF'];
            $sec = "10";
            header("Refresh: $sec; url=$page");
            // Lista de IPs e nomes
            $iplist = [
                ["8.1.8.8", "teste"],
                ["3.8.4.4", "teste DNS Backup"],
                ["1.1.1.1", "Cloudflare DNS"],
                ["1.0.0.1", "Cloudflare DNS Backup"],
                ["8.1.8.8", "teste"],
                ["8.8.4.4", "Google DNS Backup"],
                ["1.1.1.1", "Cloudflare DNS"],
                ["1.0.0.1", "Cloudflare DNS Backup"],
                ["8.8.4.4", "Google DNS Backup"],
                ["8.1.8.8", "teste"],
            ];

            foreach ($iplist as $ipInfo) {
                $ip = $ipInfo[0];
                $name = $ipInfo[1];
                $status = null;

                // Realiza o ping e obtém o status
                exec("ping -n 1 $ip", $output, $status);
                $statusClass = $status == 0 ? "status-up" : "status-down";
                $statusText = $status == 0 ? "Up" : "Down";

                // Renderiza os quadrados
                echo "
                <div class='status-box $statusClass'>
                    <div><strong>$name</strong></div>
                    <div>$ip</div>
                    <div>Status: $statusText</div>
                </div>
                ";
            }
            ?>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

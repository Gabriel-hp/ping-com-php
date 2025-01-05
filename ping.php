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
        <h1 class="text-center mb-4">Dashboard IP Status</h1>
        <div class="d-flex flex-wrap justify-content-center">
            <main>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get" class="mb-4">
                    <label for="ipseacrh">Digite o IP:</label>
                    <input type="text" name="ipseacrh" id="ipseacrh" class="form-control" placeholder="Ex: 8.8.8.8">
                    <button type="submit" class="btn btn-primary mt-3">Verificar Status</button>
                </form>
            </main>

            <?php
            // Obtém o IP da query string, se disponível
            $ipAddress = $_GET['ipseacrh'] ?? null;

            if ($ipAddress) {
                // Valida o formato do IP
                if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
                    $output = [];
                    $status = null;

                    exec("ping -n 1 $ipAddress", $output, $status);

                    $statusClass = $status === 0 ? "status-up" : "status-down";
                    $statusText = $status === 0 ? "Online" : "Offline";

                    // Renderiza o quadrado de status
                    echo "
                    <div class='status-box $statusClass'>
                        <div><strong>$ipAddress</strong></div>
                        <div>Status: $statusText</div>
                    </div>
                    ";
                } else {
                    echo "<div class='alert alert-danger'>IP inválido. Tente novamente.</div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

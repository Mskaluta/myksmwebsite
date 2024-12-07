<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deal Preordering</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .alert {
            padding: 15px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            display: none;
        }
        .success {
            background-color: #4CAF50;
        }
    </style>
    <script>
        function preorder(option, rate, dspPerUnit, moq, dspWallet) {
            const quantityInput = document.getElementById(quantity-${option});
            const quantity = parseInt(quantityInput.value);
            
            if (isNaN(quantity) || quantity < moq) {
                alert(Minimum order quantity is ${moq} units.);
                return;
            }

            const requiredDSPs = quantity * dspPerUnit;
            if (requiredDSPs > dspWallet) {
                alert(Insufficient DSP balance. You need ${requiredDSPs.toFixed(2)} DSPs but have only ${dspWallet.toFixed(2)} DSPs.);
                return;
            }

            // Create a preorder data dictionary
            const dataDictionary = {
                "Deal's name": "Vostro 7620 Dell laptop",
                "Pre Ordering option": option + "%",
                "Original preordering rate": rate.toFixed(6),
                "Current preordering rate": rate.toFixed(6),
                "DSC ruling rate": 50000.0,
                "Supplier's price": 1500.0,
                "Deal's price": 1800.0,
                "Quantity Preordered": quantity,
                "Total DSPs Required": requiredDSPs.toFixed(2)
            };

            // Output the preorder data
            document.getElementById('output').innerText = JSON.stringify(dataDictionary, null, 4);
            alert("Preorder successful!");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Deal Preordering</h1>
        <table>
            <thead>
                <tr>
                    <th>% of Future Rate</th>
                    <th>Preordering Rate</th>
                    <th>DSPs per Unit</th>
                    <th>USD Equivalent</th>
                    <th>Quantity Preordered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Define table data
                $reservationOptions = [
                    ["10%", 5000.000000, 0.360000, 18000.00],
                    ["50%", 25000.000000, 0.072000, 3600.00],
                    ["70%", 35000.000000, 0.051429, 2571.43],
                    ["90%", 45000.000000, 0.040000, 2000.00],
                    ["100%", 50000.000000, 0.036000, 1800.00],
                    ["120%", 60000.000000, 0.030000, 1500.00],
                    ["150%", 75000.000000, 0.024000, 1200.00],
                    ["200%", 100000.000000, 0.018000, 900.00],
                    ["250%", 125000.000000, 0.014400, 720.00],
                    ["300%", 150000.000000, 0.012000, 600.00],
                    ["500%", 250000.000000, 0.007200, 360.00],
                    ["800%", 400000.000000, 0.004500, 225.00],
                    ["1000%", 500000.000000, 0.003600, 180.00],
                    ["10000%", 5000000.000000, 0.000360, 18.00]
                ];
                $personalMOQ = 2;
                $dspWallet = 100;

                foreach ($reservationOptions as $index => $option) {
                    echo "<tr>
                        <td>{$option[0]}</td>
                        <td>{$option[1]}</td>
                        <td>{$option[2]}</td>
                        <td>{$option[3]}</td>
                        <td><input type='number' id='quantity-{$option[0]}' min='1' /></td>
                        <td><button onclick=\"preorder('{$option[0]}', {$option[1]}, {$option[2]}, {$personalMOQ}, {$dspWallet})\">Preorder</button></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <h2>Preorder Data</h2>
        <pre id="output"></pre>
    </div>
</body>
</html>


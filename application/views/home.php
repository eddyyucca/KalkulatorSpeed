<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Speed Buma IPR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .logo {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 100px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
        }
        input, button, select {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input, select {
            width: 100%;
            max-width: 300px;
        }
        button {
            width: 100%;
            max-width: 150px;
            align-self: center;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 20px;
        }
        .responsive-iframe {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }
        .responsive-iframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <div class="container" id="mainContent">
        <img src="https://images.typeform.com/images/q8cN9iQvumLK/image/default-firstframe.png" alt="BUMA Logo" class="logo">
        <h2 style="text-align:center;">Kalkulator Speed BUMA IPR</h2>
        <div class="form-group">
            <label for="capHauler">Type Hauler:</label>
            <select id="capHauler" name="capHauler">
                <option value="87">CAT 789 class</option>
                <option value="62">CAT 785 class</option>
                <option value="42">CAT 777 class</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jarak">Jarak (km):</label>
            <input type="text" id="jarak" name="jarak">
        </div>
        <div class="form-group">
            <label for="speedPlan">Speed Plan (km/h):</label>
            <input type="text" id="speedPlan" name="speedPlan">
        </div>
        <div class="form-group">
            <label for="fixTime">Fix Time (menit):</label>
            <input type="text" id="fixTime" name="fixTime">
        </div>
        <button onclick="calculate()">HITUNG</button>
        <hr>
        <div class="results">
            <h3 style="text-align:center;">Hasil:</h3>
            <p>Jarak (km): <span id="resultJarak"></span></p>
            <p>Speed Plan (km/h): <span id="resultSpeedPlan"></span></p>
            <p>MF: <span id="resultMF"></span></p>
            <p><b>Qty Truck: <span id="resultQtyTruck"></span></b></p>
        </div>
        <hr>
        <div class="form-group">
            <label for="qtyTruckAktual">Qty Truck Aktual:</label>
            <input type="text" id="qtyTruckAktual" name="qtyTruckAktual">
        </div>
        <button onclick="calculateAktual()">HITUNG Aktual</button>
        <div class="results">
            <h3 style="text-align:center;">Hasil Aktual:</h3>
            <p>Jarak (km): <span id="resultJarakAktual"></span></p>
            <p>MF Aktual: <span id="resultMFAktual"></span></p>
            <p>Speed Plan (km/h): <span id="resultSpeedPlanAktual"></span></p>
            <p><b>Speed Seharusnya (km/h): <span id="resultSpeedSeharusnya"></span></b></p>
        </div>
        <hr>
        <div class="responsive-iframe">
            <iframe src="https://drive.google.com/file/d/1zOaE-7foVROGE4sXeTuN__KeMfgSDGmq/preview" frameborder="0" allowfullscreen title="TableSpeed"></iframe>
        </div>
        <div class="responsive-iframe">
            <iframe src="https://drive.google.com/file/d/16CpyUrIYi-aUxahdfD5wrcrLYvWL2lX4/preview" frameborder="0" allowfullscreen title="FixTime"></iframe>
        </div>
        <div style="text-align:center; font-size:12px; margin-top:20px;">
            <b>© 2025 - Buma IPR</b>
        </div>
    </div>

    <script>
        function parseInput(input) {
            return parseFloat(input.replace(',', '.'));
        }

        function getCtLoader(capHauler) {
            switch (capHauler) {
                case 87:
                    return 2.9;
                case 62:
                    return 2.4;
                case 42:
                    return 2.9;
                default:
                    return 2.9;
            }
        }

        function calculate() {
            const jarak = parseInput(document.getElementById('jarak').value);
            const speedPlan = parseInput(document.getElementById('speedPlan').value);
            const fixTime = parseInput(document.getElementById('fixTime').value);
            const capHauler = parseFloat(document.getElementById('capHauler').value);
            const ctLoader = getCtLoader(capHauler);
            const travelTime = (jarak * 2 / speedPlan) * 60;
            const ctHauler = travelTime + fixTime;
            const qtyTruck = ctHauler / ctLoader;
            const ptyLoader = (60 / ctLoader) * capHauler;
            const ptyHauler = (60 / ctHauler) * capHauler;
            const mf = (ptyHauler * qtyTruck) / ptyLoader;

            document.getElementById('resultJarak').innerText = jarak;
            document.getElementById('resultSpeedPlan').innerText = speedPlan;
            document.getElementById('resultQtyTruck').innerText = qtyTruck.toFixed(1);
            document.getElementById('resultMF').innerText = mf.toFixed(2);
        }

        function calculateAktual() {
            const jarak = parseInput(document.getElementById('jarak').value);
            const speedPlan = parseInput(document.getElementById('speedPlan').value);
            const qtyTruckAktual = parseInput(document.getElementById('qtyTruckAktual').value);
            const fixTime = parseInput(document.getElementById('fixTime').value);
            const capHauler = parseFloat(document.getElementById('capHauler').value);
            const ctLoader = getCtLoader(capHauler);
            const travelTime = (jarak * 2 / speedPlan) * 60;
            const ctHauler = travelTime + fixTime;
            const qtyTruck = ctHauler / ctLoader;
            const ptyLoader = (60 / ctLoader) * capHauler;
            const ptyHauler = (60 / ctHauler) * capHauler;
            const mfAktual = (ptyHauler * qtyTruckAktual) / ptyLoader;
            const speedSeharusnya = (jarak * 2) / ((ctLoader * qtyTruckAktual - fixTime) / 60);

            document.getElementById('resultJarakAktual').innerText = jarak;
            document.getElementById('resultSpeedPlanAktual').innerText = speedPlan;
            document.getElementById('resultSpeedSeharusnya').innerText = speedSeharusnya.toFixed(1);
            document.getElementById('resultMFAktual').innerText = mfAktual.toFixed(1);
        }
    </script>
</body>
</html>
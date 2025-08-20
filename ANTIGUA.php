<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f1f1f1;
            font-family: Arial, sans-serif;
            
        }
        .calculator {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            width: 300px;
            box-sizing: border-box; /* prevent overflow */
        }

        .display {
            width: 100%;
            height: 60px;
            font-size: 28px;
            text-align: right;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background: #e9e9e9;
            box-sizing: border-box; /* important fix */
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .buttons button {
            padding: 20px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        
        

    </style>
</head>
<body>

<div class="calculator">
    <form method="post">
        <input type="text" class="display" name="display" value="<?php if(isset($_POST['display'])) echo $_POST['display']; ?>" readonly>
        <div class="buttons">
            <button type="submit" name="btn" value="%">%</button>
            <button type="submit" name="btn" value="CE">CE</button>
            <button type="submit" name="btn" value="C">C</button>
            <button type="submit" name="btn" value="/">÷</button>

            <button type="submit" name="btn" value="7">7</button>
            <button type="submit" name="btn" value="8">8</button>
            <button type="submit" name="btn" value="9">9</button>
            <button type="submit" name="btn" value="*">×</button>

            <button type="submit" name="btn" value="4">4</button>
            <button type="submit" name="btn" value="5">5</button>
            <button type="submit" name="btn" value="6">6</button>
            <button type="submit" name="btn" value="-">−</button>

            <button type="submit" name="btn" value="1">1</button>
            <button type="submit" name="btn" value="2">2</button>
            <button type="submit" name="btn" value="3">3</button>
            <button type="submit" name="btn" value="+">+</button>

            <button type="submit" name="btn" value="+/-">+/-</button>
            <button type="submit" name="btn" value="0">0</button>
            <button type="submit" name="btn" value=".">.</button>
            <button type="submit" class="equal" name="btn" value="=">=</button>
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $display = $_POST['display'] ?? '';
    $btn = $_POST['btn'] ?? '';

    if ($btn == "C") {
        $display = "";
    } elseif ($btn == "CE") {
        $display = substr($display, 0, -1);
    } elseif ($btn == "=") {
        try {
            // Secure eval for math
            $display = eval("return ".$display.";");
        } catch (Throwable $e) {
            $display = "Error";
        }
    } elseif ($btn == "+/-") {
        if ($display != "") {
            $display = (string)(-1 * floatval($display));
        }
    } else {
        $display .= $btn;
    }
    echo "<script>document.getElementsByName('display')[0].value = '". $display ."';</script>";
}
?>

</body>
</html>
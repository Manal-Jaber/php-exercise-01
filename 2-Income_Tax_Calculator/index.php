<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    $salaryErr = $monthvsyearErr = $allowanceErr = "";

    function getTax($num){
        if($num<10000){
            return 0;
        }elseif ($num < 25000) {
            return $num*11/100;
        }elseif ($num < 50000) {
            return $num*30/100;
        }else {
            return $num*45/100;
        }
    }
    function getFee($num){
        if($num<10000){
            return 0;
        }else {
            return $num*4/100;
        }
    }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['calculate'])){
        if(empty($_POST["salary"])){
            $salaryErr = "This is a required field";
        }
        if(empty($_POST["monthvsyear"])){
            $monthvsyearErr = "This is a required field";
        }
        if(empty($_POST["allowance"])){
            $allowanceErr = "This is a required field";
        }
    }
    if($salaryErr == "" && $monthvsyearErr == "" && $allowanceErr == ""){
        if(isset($_POST["monthvsyear"]) && ($_POST["monthvsyear"]=="monthly")){
            $monthTotal= $_POST["salary"];
            $yearTotal= $monthTotal *12;
            $yearTax = getTax($yearTotal);
            $yearFee= getFee($yearTotal);
            $yearAfter = $yearTotal - $yearTax - $yearFee +$_POST["allowance"];
            $monthTax = $yearTax/12;
            $monthFee= $yearFee/12;
            $monthAfter= $yearAfter/12;
        }
        if(isset($_POST["monthvsyear"]) && ($_POST["monthvsyear"]=="yearly")){
            $yearTotal= $_POST["salary"];
            $yearTax = getTax($yearTotal);
            $yearFee= getFee($yearTotal);
            $yearAfter = $yearTotal - $yearTax - $yearFee +$_POST["allowance"];
            $monthTotal= $yearTotal/12;
            $monthTax = $yearTax/12;
            $monthFee= $yearFee/12;
        }
    }
 }
?>

    <div class="wrapper">
        <form id="user"  action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
            <h1>Enter your Data</h1>
            <div class="input">
                <label for="salary">Salary in USD: <span class = "error">* <?php echo $salaryErr;?></span><input type="number" id="salary" name = "salary" placeholder="$$"></label>
            </div>
            <div class="input"><span class = "error">* <?php echo $monthvsyearErr;?></span>
            <input type="radio" id="monthly" name="monthvsyear" value="monthly">
                <label for="monthly">Monthly</label><br>
            <input type="radio" id="yearly" name="monthvsyear" value="yearly">
                <label for="yearly">Yearly</label><br>
            </div>
            <div class="input">
                <label for="allowance">Tax Free Allowance in USD : <span class = "error">* <?php echo $allowanceErr;?></span><input id="allowance" name = "allowance" type="number" placeholder="$$"></label>
            </div>
                <button id="btn" onclick="submit" name="calculate" value="calculate">Calculate</button>
        </form>
        <form class="table_section">
            <h1 class="table_title">Results</h1>
            <table class="table">
                <tr>
                    <th> </th>
                    <th>Monthly</th>
                    <th>Yearly</th>
                </tr>
                <tr>
                    <th>Total salary</th>
                    <td><?php echo $monthTotal; ?></td>
                    <td><?php echo $yearTotal; ?></td>
                </tr>
                <tr>
                    <th>Tax amount</th>
                    <td><?php echo $monthTax; ?></td>
                    <td><?php echo $yearTax; ?></td>
                </tr>
                <tr>
                    <th>Social security fee</th>
                    <td><?php echo $monthFee; ?></td>
                    <td><?php echo $yearFee; ?></td>
                </tr>
                <tr>
                    <th>Salary after tax</th>
                    <td><?php echo $monthAfter; ?></td>
                    <td><?php echo $yearAfter; ?></td>
                </tr>
            </table>
</form>
    </div>
</body>
</html>
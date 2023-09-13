<?php
$investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
$interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
$years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_FLOAT);

if ($investment === false) {
    $error_message = 'Investment must be a valid number.';
} else if ($interest_rate === false) {
    $error_message = 'Interest must be a valid number.';
} else if ($interest_rate <= 0) {
    $error_message = 'Interest rate must be greater than zero.';
} else if ($years === false) {
    $error_message = 'Years must be a valid whole number.';
} else if ($years <= 0) {
    $error_message = 'Years must be greate than zero.';
} else if ($years > 30) {
    $error_message = 'Years must be less than 30.';
} else {
    $error_message = '';
}

if ($error_message != '') {
    include('index.php');
    exit();
}

$future_value = $investment;
for ($i = 0; $i < $years; $i++) {
    $future_value += $future_value * .01 * $interest_rate;
}

$investment_f = number_format($investment, 2);
$yearly_rate_f = $interest_rate . '%';
$future_value_f = number_format($future_value, 2);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>
    </main>
</body>

</html>
<?php
session_start();

// Handle reset BEFORE doing anything else
if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit(); // Prevent code from continuing
}

$correct_flags = [
    0 => "FLAG{this_is_the_first_one!}",
    1 => "FLAG{how_did_you_find_me!?}",
    2 => "FLAG{im_at_home}",
    3 => "FLAG{you_read_this_right}",
    4 => "FLAG{wow_im_back_alive!}",
    5 => "FLAG{always_keep_it_safe}",
    6 => "FLAG{convenient_but_dangerous_to_store_creds}",
    7 => "FLAG{keep_your_private_key_secure}",
    8 => "FLAG{be_careful_even_if_seemingly_safe}",
    9 => "FLAG{you_are_skilled_enough!}"
];

// Initialize progress session array
if (!isset($_SESSION["solved"])) {
    $_SESSION["solved"] = [];
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($_POST as $key => $value) {
        if (preg_match('/^submit(\d+)$/', $key, $matches)) {
            $flag_id = (int)$matches[1];
            $submitted_flag = $_POST["flag$flag_id"] ?? "";
            if ($submitted_flag === $correct_flags[$flag_id]) {
                $_SESSION["solved"][$flag_id] = true; // Mark as solved
                $results[$flag_id] = true;
            } else {
                $results[$flag_id] = false;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CTF Flag Submission</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>🔒 CTF Flag Submission Terminal</h1>

    <?php for ($i = 0; $i < 10; $i++): ?>
        <form method="POST" class="flag-form">
            <label>Flag<?= $i ?>:</label>
            <?php if ($i == 0): ?>
                <p>hint: Use 'ls' command. You can read a file with 'cat'.</p>
            <?php elseif ($i == 1): ?>
                <p>hint: Do you know how to list all files in a directory?</p>
            <?php elseif ($i == 2): ?>
                <p>hint: Use 'cd' command. Go upper.</p>
            <?php elseif ($i == 3): ?>
                <p>hint: Let's go to the root! You need to decode the flag before submission.</p>
            <?php elseif ($i == 4): ?>
                <p>hint: Use 'find' command. Files containing a flag follow "flag*.txt" name format.</p>
            <?php elseif ($i == 5): ?>
                <p>hint: Do you know bash keeps history of executed commands and sometimes includes credentials?</p>
            <?php elseif ($i == 6): ?>
                <p>hint: Hey John, I told you not to store the flag in 'env' variables!</p>
            <?php elseif ($i == 7): ?>
                <p>hint: Michael's misconfiguration allows an attacker to establish SSH connection.</p>
            <?php elseif ($i == 8): ?>
                <p>hint: Do you know 'sudo' and how dangerous it would be when misused?</p>
            <?php elseif ($i == 9): ?>
                <p>hint: Yeah the executable file is vulnerable to pathjacking I can assure you.</p>
            <?php endif; ?>
            <div class="input-area">
                <input type="text" name="flag<?= $i ?>" placeholder="FLAG{...}" required>
                <button type="submit" name="submit<?= $i ?>">Submit</button>
            </div>
            <?php if (!empty($_SESSION["solved"][$i])): ?>
                <div class="success">✅ Correct – <?= htmlspecialchars($correct_flags[$i]) ?></div>
            <?php elseif (isset($results[$i]) && !$results[$i]): ?>
                <div class="error">❌ Wrong</div>
            <?php endif; ?>
        </form>
    <?php endfor; ?>

    <a href="?reset=1" style="color: #ff5555; display: block; margin-top: 20px;">🔁 Reset All Flags</a>
</body>

</html>
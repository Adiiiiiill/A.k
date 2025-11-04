<?php
// Folder jahan fan photos save hongi
$target_dir = "uploads/";

// Agar folder nahi bana hai to create karo
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check karo file aayi hai ya nahi
if (isset($_FILES["fanPhoto"])) {
    $file = $_FILES["fanPhoto"];

    // File ka naam aur extension lo
    $fileName = basename($file["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // New random name generate karo (AdilFan_ + time)
    $newName = "AdilFan_" . time() . "." . $fileType;
    $target_file = $target_dir . $newName;

    // File size limit (5MB)
    if ($file["size"] > 5 * 1024 * 1024) {
        echo "<h2 style='color:red;text-align:center;margin-top:40px;'>❌ File too large (max 5 MB)</h2>";
        exit;
    }

    // Sirf images allow (jpg, png, jpeg, gif)
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "<h2 style='color:red;text-align:center;margin-top:40px;'>❌ Only JPG, PNG, or GIF allowed!</h2>";
        exit;
    }

    // Move uploaded file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "
        <body style='background:radial-gradient(circle at top,#0b0211,#1a0030);color:white;font-family:Poppins;text-align:center;'>
            <h2 style='color:#a855f7;margin-top:60px;'>💜 Upload Successful 💜</h2>
            <p>Your photo has been added to the BTS Fan Gallery.</p>
            <img src='$target_file' style='max-width:300px;border-radius:14px;box-shadow:0 0 20px #a855f7;margin-top:20px;'>
            <p style='margin-top:20px;color:#ccc;'>Saved as: <b>$newName</b></p>
            <a href='fans.html' style='display:inline-block;margin-top:20px;padding:10px 20px;background:#a855f7;color:white;text-decoration:none;border-radius:10px;'>⬅ Back to Fans Page</a>
        </body>";
    } else {
        echo "<h2 style='color:red;text-align:center;margin-top:40px;'>❌ Upload failed. Try again.</h2>";
    }
} else {
    echo "<h2 style='color:#a855f7;text-align:center;margin-top:40px;'>No file uploaded.</h2>";
}
?>

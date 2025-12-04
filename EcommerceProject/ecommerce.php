<?php
// ==========================
// PHP E-COMMERCE DEMO SCRIPT
// ==========================

// --------------------------
// 1. REUSABLE FUNCTIONS
// --------------------------

// Function to calculate total cost including 10% sales tax
function calculateTotal($price, $quantity) {
    $subtotal = $price * $quantity;
    $tax = $subtotal * 0.10; // 10% tax
    return $subtotal + $tax;
}

// Function to format product names
function formatProductName($name) {
    $name = trim($name); // Remove extra spaces
    $name = ucwords($name); // Capitalize first letter of each word
    if (strlen($name) > 50) {
        $name = substr($name, 0, 50); // Limit to 50 chars
    }
    return $name;
}

// Function to calculate discounted price
function calculateDiscount($price, $discountPercent) {
    return $price - ($price * ($discountPercent / 100));
}

// --------------------------
// 2. ARRAY MANIPULATION
// --------------------------

// a) List of products
$products = [
    ['name' => 'Laptop', 'category' => 'Electronics', 'price' => 1200],
    ['name' => 'Smartphone', 'category' => 'Electronics', 'price' => 800],
    ['name' => 'Coffee Mug', 'category' => 'Home', 'price' => 15],
    ['name' => 'Laptop', 'category' => 'Electronics', 'price' => 1200], // Duplicate
];

// Remove duplicates by converting to JSON string to compare arrays
$uniqueProducts = array_map("unserialize", array_unique(array_map("serialize", $products)));

// Sort by price ascending
usort($uniqueProducts, function($a, $b) {
    return $a['price'] <=> $b['price'];
});

echo "=== Product List ===\n";
foreach ($uniqueProducts as $p) {
    echo formatProductName($p['name']) . " - $" . $p['price'] . "\n";
}

// b) Apply 10% discount to Electronics
echo "\n=== Electronics Discount Applied ===\n";
foreach ($uniqueProducts as &$p) {
    if ($p['category'] == 'Electronics') {
        $p['price'] = calculateDiscount($p['price'], 10);
    }
    echo formatProductName($p['name']) . " (" . $p['category'] . ") - $" . $p['price'] . "\n";
}
unset($p); // Break reference

// c) Merge two supplier inventories
$supplier1 = [
    ['name' => 'Headphones', 'category' => 'Electronics', 'price' => 150],
    ['name' => 'Desk Lamp', 'category' => 'Home', 'price' => 30],
];
$supplier2 = [
    ['name' => 'Laptop', 'category' => 'Electronics', 'price' => 1080], // Already exists
    ['name' => 'Notebook', 'category' => 'Stationery', 'price' => 5],
];

$merged = array_merge($uniqueProducts, $supplier1, $supplier2);
$mergedUnique = array_map("unserialize", array_unique(array_map("serialize", $merged)));

echo "\n=== Merged Inventory ===\n";
foreach ($mergedUnique as $p) {
    echo formatProductName($p['name']) . " (" . $p['category'] . ") - $" . $p['price'] . "\n";
}

// --------------------------
// 3. STRING MANIPULATION
// --------------------------

// a) Format product descriptions
$description = "High_Quality_Leather_Wallet_With_RFID_Protection!";
$formattedDesc = strtolower(str_replace("_", " ", $description));
$formattedDesc = preg_replace("/[^a-z0-9\s]/", "", $formattedDesc); // remove special chars
echo "\nFormatted Description: $formattedDesc\n";

// b) Analyze description
$descriptionAnalysis = "This is a high-quality leather wallet with RFID protection.";
$totalChars = strlen($descriptionAnalysis);
$totalWords = str_word_count($descriptionAnalysis);
$keyword = strpos(strtolower($descriptionAnalysis), "leather") !== false ? "Keyword found" : "Keyword not found";

echo "\nDescription Analysis:\n";
echo "Total characters: $totalChars\n";
echo "Total words: $totalWords\n";
echo "$keyword\n";

// c) Customer review processing
$review = "Great product! Fast delivery and excellent service.";
$preview = substr($review, 0, 20) . "...";
$position = strpos($review, "excellent");
$positionOutput = $position !== false ? "Found at position $position" : "Not found";
$fullReview = $review . " Thank you for your feedback!";

echo "\nCustomer Review:\n";
echo "Preview: $preview\n";
echo "Position of 'excellent': $positionOutput\n";
echo "Full Review: $fullReview\n";

// --------------------------
// 4. Example usage of calculateTotal
// --------------------------
echo "\n=== Example Total Calculation ===\n";
$total = calculateTotal(100, 3);
echo "Total for 3 items at $100 each (with 10% tax): $" . $total . "\n";

?>

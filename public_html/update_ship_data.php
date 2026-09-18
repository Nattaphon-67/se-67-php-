<?php
$servername = "db";
$username = "admin";
$password = "1234";
$dbname = "titanic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstNames = [
    "Adit",
    "Bima",
    "Citra",
    "Dewi",
    "Eka",
    "Fajar",
    "Gita",
    "Hadi",
    "Indra",
    "Joko",
    "Kirana",
    "Lutfi",
    "Maya",
    "Nadia",
    "Omar",
    "Pandu",
    "Qila",
    "Raka",
    "Sari",
    "Toni",
    "Umi",
    "Vega",
    "Wawan",
    "Xena",
    "Yoga",
    "Zahra",
    "Ardi",
    "Bella",
    "Chairul",
    "Dina",
    "Evan",
    "Fira",
    "Galih",
    "Hana",
    "Iqbal",
    "Jasmine",
    "Kiko",
    "Lina",
    "Miko",
    "Nisa",
    "Oki",
    "Putri",
    "Rifqi",
    "Sinta",
    "Taufik",
    "Vina",
    "Wira",
    "Yeni",
    "Zaki",
    "Ayu",
    "Brian",
    "Celine",
    "Damar",
    "Elli",
    "Farhan",
    "Gadis",
    "Hendra",
    "Ika",
    "Januar",
    "Keisha",
    "Lukman",
    "Mira",
    "Naufal",
    "Olivia",
    "Prasetya",
    "Rina",
    "Sukma",
    "Tara",
    "Ujang",
    "Vanya",
    "Wahyudi",
    "Xavier",
    "Yuliana",
    "Zulfan",
    "Adinda",
    "Bobby",
    "Candra",
    "Della",
    "Eko",
    "Fany",
    "Gilang",
    "Harun",
    "Intan",
    "Jefri",
    "Kartika",
    "Lia",
    "Musa",
    "Neng",
    "Opal",
    "Prilly",
    "Rian",
    "Salsabila",
    "Titis",
    "Ulfa",
    "Vito",
    "Wulan",
    "Yasmin",
    "Zidan"
];

$lastNames = [
    "Santoso",
    "Wijaya",
    "Pratama",
    "Nugroho",
    "Ramadhani",
    "Putri",
    "Aisyah",
    "Hidayat",
    "Siregar",
    "Arifin",
    "Hartono",
    "Suryadi",
    "Susanto",
    "Kurniawan",
    "Maulana",
    "Rahman",
    "Nasution",
    "Gunawan",
    "Purnomo",
    "Mardani",
    "Permana",
    "Febriani",
    "Ananda",
    "Wibowo",
    "Halim",
    "Rahayu",
    "Sutrisno",
    "Dewantara",
    "Maharani",
    "Rizky",
    "Cahyono",
    "Prakoso",
    "Subroto",
    "Kusuma",
    "Utami",
    "Darmawan",
    "Lestari",
    "Fauzi",
    "Handayani",
    "Saputra",
    "Wulandari",
    "Suharto",
    "Andriani",
    "Ramdhan",
    "Setiawan",
    "Sari",
    "Hakim",
    "Wardana",
    "Taher",
    "Halim",
    "Wibisono",
    "Yudistira",
    "Kusnadi",
    "Pangestu"
];

$ships = [
    "Astra Voyager",
    "Blue Horizon",
    "Coral Meridian",
    "Dawn Pearl",
    "Emerald Wave",
    "Fjord Glory",
    "Golden Star",
    "Harbor Light",
    "Island Runner",
    "Jetstream Nova",
    "Kingfisher Bay",
    "Luna Crest",
    "Mariner Queen",
    "Northwind Seal",
    "Ocean Whisper",
    "Pacific Echo",
    "Quartz Dream",
    "Riviera Tide",
    "Seabird Atlas",
    "Thunder Crest"
];

$conn->query("TRUNCATE TABLE titanic");

$usedNames = [];
$inserted = 0;

for ($i = 1; $i <= 150; $i++) {
    do {
        $name = $firstNames[array_rand($firstNames)] . " " . $lastNames[array_rand($lastNames)];
    } while (isset($usedNames[$name]));

    $usedNames[$name] = true;

    $ship = $ships[array_rand($ships)];
    $ticket = strtoupper(substr($ship, 0, 3)) . "-" . str_pad((string) $i, 4, "0", STR_PAD_LEFT);
    $survived = random_int(0, 1);
    $pclass = random_int(1, 3);
    $sex = (random_int(0, 1) === 0) ? "male" : "female";
    $age = round(random_int(18, 72) + (random_int(0, 99) / 100), 1);
    $sibsp = random_int(0, 3);
    $parch = random_int(0, 2);
    $fare = round(random_int(35, 480) + (random_int(0, 99) / 100), 2);
    $cabin = chr(65 + random_int(0, 5)) . random_int(1, 20);
    $embarked = ["C", "S", "Q"][array_rand(["C", "S", "Q"])];

    $stmt = $conn->prepare(
        "INSERT INTO titanic (`index`, `PassengerId`, `Survived`, `Pclass`, `Name`, `Sex`, `Age`, `SibSp`, `Parch`, `Ticket`, `Fare`, `Cabin`, `Embarked`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "iiisssdisdsss",
        $i,
        $i,
        $survived,
        $pclass,
        $name,
        $sex,
        $age,
        $sibsp,
        $parch,
        $ticket,
        $fare,
        $cabin,
        $embarked
    );

    $stmt->execute();
    $stmt->close();
    $inserted++;
}

echo "Inserted {$inserted} unique ship passengers with randomized names and ticket codes.";
$conn->close();

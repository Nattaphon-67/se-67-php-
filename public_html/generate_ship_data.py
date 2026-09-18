import random

random.seed(20260918)

first_names = [
    "Adit", "Bima", "Citra", "Dewi", "Eka", "Fajar", "Gita", "Hadi", "Indra", "Joko",
    "Kirana", "Lutfi", "Maya", "Nadia", "Omar", "Pandu", "Qila", "Raka", "Sari", "Toni",
    "Umi", "Vega", "Wawan", "Xena", "Yoga", "Zahra", "Ardi", "Bella", "Chairul", "Dina",
    "Evan", "Fira", "Galih", "Hana", "Iqbal", "Jasmine", "Kiko", "Lina", "Miko", "Nisa",
    "Oki", "Putri", "Rifqi", "Sinta", "Taufik", "Vina", "Wira", "Yeni", "Zaki", "Ayu",
    "Brian", "Celine", "Damar", "Elli", "Farhan", "Gadis", "Hendra", "Ika", "Januar", "Keisha",
    "Lukman", "Mira", "Naufal", "Olivia", "Prasetya", "Rina", "Sukma", "Tara", "Ujang", "Vanya",
    "Wahyudi", "Xavier", "Yuliana", "Zulfan", "Adinda", "Bobby", "Candra", "Della", "Eko", "Fany",
    "Gilang", "Harun", "Intan", "Jefri", "Kartika", "Lia", "Musa", "Neng", "Opal", "Prilly",
    "Rian", "Salsabila", "Titis", "Ulfa", "Vito", "Wulan", "Yasmin", "Zidan"
]

last_names = [
    "Santoso", "Wijaya", "Pratama", "Nugroho", "Ramadhani", "Putri", "Aisyah", "Hidayat", "Siregar", "Arifin",
    "Hartono", "Suryadi", "Susanto", "Kurniawan", "Maulana", "Rahman", "Nasution", "Yuliana", "Gunawan", "Purnomo",
    "Mardani", "Permana", "Febriani", "Ananda", "Wibowo", "Halim", "Rahayu", "Sutrisno", "Dewantara", "Maharani",
    "Rizky", "Cahyono", "Prakoso", "Subroto", "Kusuma", "Utami", "Darmawan", "Lestari", "Fauzi", "Handayani",
    "Saputra", "Wulandari", "Suharto", "Andriani", "Ramdhan", "Setiawan", "Sari", "Hakim", "Wardana", "Taher"
]

ships = [
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
]

used_names = set()
records = []

for i in range(1, 201):
    while True:
        name = f"{random.choice(first_names)} {random.choice(last_names)}"
        if name not in used_names:
            used_names.add(name)
            break

    sex = random.choice(["male", "female"])
    pclass = random.randint(1, 3)
    survived = random.randint(0, 1)
    age = round(random.uniform(18, 72), 1)
    sibsp = random.randint(0, 3)
    parch = random.randint(0, 2)
    fare = round(random.uniform(35, 480), 2)
    cabin = random.choice(["A", "B", "C", "D", "E", "F"]) + str(random.randint(1, 20))
    embarked = random.choice(["C", "S", "Q"])
    ship = random.choice(ships)
    ticket = f"{ship[:3].upper()}-{i:04d}"

    records.append(
        (
            i,
            i,
            survived,
            pclass,
            name,
            sex,
            age,
            sibsp,
            parch,
            ticket,
            fare,
            cabin,
            embarked,
            ship,
        )
    )

with open("ship_data.sql", "w", encoding="utf-8") as f:
    f.write("TRUNCATE TABLE titanic;\n")
    f.write(
        "INSERT INTO titanic (`index`, `PassengerId`, `Survived`, `Pclass`, `Name`, `Sex`, `Age`, `SibSp`, `Parch`, `Ticket`, `Fare`, `Cabin`, `Embarked`) VALUES\n"
    )
    values_sql = []
    for row in records:
        values_sql.append(
            "({0}, {1}, {2}, {3}, '{4}', '{5}', {6}, {7}, {8}, '{9}', {10}, '{11}', '{12}')".format(
                row[0], row[1], row[2], row[3], row[4].replace("'", "''"), row[5], row[6], row[7], row[8], row[9], row[10], row[11], row[12]
            )
        )
    f.write(",\n".join(values_sql) + ";\n")

print(f"Generated {len(records)} unique ship-passenger records to ship_data.sql")

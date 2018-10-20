<?php

$servername = "localhost";
$username = "root";
$password = "dsfdsfduiewyr78y7dfuijknsd";

// Reset Mysql Password
// exec('~/http/bin/mysql.server reset-pass "$password"');


// Create connection
$conn = new mysqli($servername, $username, $password);

function exec_query($conn, $sql)
{
	if ($conn->query($sql) === TRUE) {
	    echo "Query Success!<br/>";
	} else {
	    echo "Error database: " . $conn->error;
	}
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br/>";


// Drop database
$sql = "DROP DATABASE IF EXISTS shop";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully<br/>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Create database
$sql = "CREATE DATABASE shop";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br/>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Create Table User
$sql = "CREATE TABLE `shop`.`users`  (
	  `user_id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) NOT NULL,
	  `mail` varchar(100) NOT NULL,
	  `password` varchar(200) NOT NULL,
	  `address` varchar(1000) NOT NULL,
	  `is_admin` tinyint(10) NOT NULL DEFAULT 0,
	  `active` tinyint(10) NOT NULL DEFAULT 0,
	  PRIMARY KEY (`user_id`)
	);";
exec_query($conn, $sql);

// Create Table Products
$sql = "CREATE TABLE `shop`.`products`  (
	  `id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) NOT NULL,
	  `description` varchar(1000) DEFAULT '',
	  `image_sm` varchar(1000) DEFAULT 'http://placehold.it/700x400',
	  `image_xl` varchar(1000) DEFAULT 'http://placehold.it/900x400',
	  `price` decimal(10, 2) NOT NULL,
	  `status` tinyint(10) NOT NULL DEFAULT 1,
	  PRIMARY KEY (`id`)
	);";
exec_query($conn, $sql);

// Create Table Category
$sql = "CREATE TABLE `shop`.`categories`  (
	  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) NOT NULL,
	  PRIMARY KEY (`cat_id`)
	);";
exec_query($conn, $sql);

// Create Table Cat_list
$sql = "CREATE TABLE `shop`.`cat_list`  (
	  `cat_list_id` int(10) NOT NULL AUTO_INCREMENT,
	  `cat_id` int(10) NOT NULL,
	  `pd_id` int(10) NOT NULL,
	  PRIMARY KEY (`cat_list_id`)
	);";
exec_query($conn, $sql);

// Create Table Commands
$sql = "CREATE TABLE `shop`.`commands`  (
	  `com_id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) NOT NULL,
	  `created` datetime NOT NULL,
	  PRIMARY KEY (`com_id`)
	);";
exec_query($conn, $sql);

// Create Table Commands Details
$sql = "CREATE TABLE `shop`.`commands_details`  (
	  `det_id` int(10) NOT NULL AUTO_INCREMENT,
	  `order_id` int(10) NOT NULL,
	  `pd_id` int(10) NOT NULL,
	  `quantity` int(10) NOT NULL,
	  `price` decimal(10, 2) NOT NULL,
	  PRIMARY KEY (`det_id`)
	);";
exec_query($conn, $sql);

// Foreign Key
// $sql = "ALTER TABLE `shop`.`commands` 
// ADD FOREIGN KEY (`user_id`) REFERENCES `shop`.`users` (`user_id`) ON DELETE CASCADE;";
// exec_query($conn, $sql);

// Insert Categories
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (1, 'Fire');";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (2, 'Grass');";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (3, 'Water');";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (4, 'Electric');";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (5, 'Poison');";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`categories`(`cat_id`, `name`) VALUES (6, 'Flying');";
exec_query($conn, $sql);

// Insert Articles
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (1, 'Charmander', 'The Lizard Pokémon. When the tip of Charmander\'s tail burns brightly, that indicates it\'s in good health.', 'https://cdn.bulbagarden.net/upload/thumb/7/73/004Charmander.png/250px-004Charmander.png',  74.90, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (2, 'Bulbasaur', 'The Seed Pokémon. A young Bulbasaur uses the nutrients from its seed for the energy it needs to grow.', 'https://cdn.bulbagarden.net/upload/thumb/2/21/001Bulbasaur.png/250px-001Bulbasaur.png', 68.90, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (3, 'Squirtle', 'Squirtle, the Tiny Turtle Pokémon. During battle, Squirtle hides in its shell that sprays water at its opponent whenever it can.', 'https://cdn.bulbagarden.net/upload/thumb/3/39/007Squirtle.png/250px-007Squirtle.png', 73.90, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (4, 'Pikachu', 'The Mouse Pokémon. It can generate electric attacks from the electric pouches located in both of its cheeks.', 'https://cdn.bulbagarden.net/upload/thumb/0/0d/025Pikachu.png/250px-025Pikachu.png', 82.50, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (5, 'Ivysaur', 'The Seed Pokémon. As Ivysaur takes in nutrients, a large flower blooms from the bulb on its back.', 'https://cdn.bulbagarden.net/upload/thumb/7/73/002Ivysaur.png/250px-002Ivysaur.png', 119.80, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (6, 'Venusaur', 'The Seed Pokémon. Venusaur uses its large petals to capture sunlight and transform it into energy.', 'https://cdn.bulbagarden.net/upload/thumb/a/ae/003Venusaur.png/250px-003Venusaur.png', 157.70, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (7, 'Charmeleon', 'The Flame Pokémon. It has razor-sharp claws and its tail is exceptionally strong.', 'https://cdn.bulbagarden.net/upload/thumb/4/4a/005Charmeleon.png/250px-005Charmeleon.png', 127.80, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (8, 'Charizard', 'The Flame Pokémon. Charizard\'s powerful flame can melt absolutely anything.', 'https://cdn.bulbagarden.net/upload/thumb/7/7e/006Charizard.png/250px-006Charizard.png', 169.70, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (9, 'Ekans', 'The older it gets, the longer it grows. At night, it wraps its long body around tree branches to rest.', 'https://cdn.bulbagarden.net/upload/thumb/f/fa/023Ekans.png/250px-023Ekans.png', 52.40, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (10, 'Arbok', '	If it encounters an enemy, it raises its head, intimidating the opponent with the frightening pattern on its body', 'https://cdn.bulbagarden.net/upload/thumb/c/cd/024Arbok.png/250px-024Arbok.png', 92.60, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (11, 'Farfetch\'d', 'Lives where reedy plants grow. They are rarely seen, so it\'s thought their numbers are decreasing.', 'https://cdn.bulbagarden.net/upload/thumb/f/f8/083Farfetch%27d.png/250px-083Farfetch%27d.png', 61.50, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (12, 'Spearow', 'Inept at flying high. However, it can fly around very fast to protect its territory.', 'https://cdn.bulbagarden.net/upload/thumb/8/8b/021Spearow.png/250px-021Spearow.png', 30.10, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (13, 'Zubat', 'It has neither eyes nor a nose. It emits ultrasonic cries that bounce back to its large ears, enabling it to fly safely.', 'https://cdn.bulbagarden.net/upload/thumb/d/da/041Zubat.png/250px-041Zubat.png', 74.60, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (14, 'Wartortle', 'The Turtle Pokémon. The evolved form of Squirtle. A highly sought after Pokémon because its long fur-covered tail is said to bring good luck.', 'https://cdn.bulbagarden.net/upload/thumb/0/0c/008Wartortle.png/250px-008Wartortle.png', 125.80, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (15, 'Blastoise', 'The Shellfish Pokémon. Blastoise\'s heavy body weight can make opponents unable to battle. It retreats into its shell when necessary.', 'https://cdn.bulbagarden.net/upload/thumb/0/02/009Blastoise.png/250px-009Blastoise.png', 173.70, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`products`(`id`, `name`, `description`, `image_sm`, `price`, `status`) VALUES (16, 'Voltorb', 'It is said to camouflage itself as a Poké Ball. It will self-destruct with very little stimulus.', 'https://cdn.bulbagarden.net/upload/thumb/d/da/100Voltorb.png/250px-100Voltorb.png', 47.60, 1);";
exec_query($conn, $sql);

// Insert Cat List
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (1, 1);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (2, 2);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 2);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (3, 3);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (4, 4);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (2, 5);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 5);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (2, 6);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 6);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (1, 7);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (1, 8);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (6, 8);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 9);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 10);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (6, 11);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (6, 12);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (6, 13);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (5, 13);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (3, 14);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (3, 15);";
exec_query($conn, $sql);
$sql = "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES (4, 16);";
exec_query($conn, $sql);

// Insert admin User
$sql = "INSERT INTO `shop`.`users`(`user_id`, `name`, `mail`, `password`, `address`, `is_admin`, `active`) VALUES (1, 'admin', 'admin@admin.fr', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 'Ecole 42 Paris', 1, 1);";
exec_query($conn, $sql);

$conn->close();

?>
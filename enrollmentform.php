<?php
  $page_title = 'Enrollment Form';
  require_once('includes/load.php');

?><?php
// Retrieve form data
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$address = $_POST['address'];
$province = $_POST['province'];
$city = $_POST['city'];
$barangay = $_POST['barangay'];
$email = $_POST['email'];
$contactnumber = $_POST['contactnumber'];

// Validate form data
if (empty($firstname) || empty($lastname) || empty($age) || empty($address) || empty($province) || empty($city) || empty($barangay) || empty($email) || empty($contactnumber)) {
    echo "Error: All fields are required.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format.";
    exit;
}

if (!preg_match('/^\d{10}$/', $contactnumber)) {
    echo "Error: Invalid contact number format.";
    exit;
}

?>


<form method="post" action="process-form.php">
  <label for="firstname">First Name:</label>
  <input type="text" id="firstname" name="firstname" required>
  <br>

  <label for="middlename">Middle Name:</label>
  <input type="text" id="middlename" name="middlename">
  <br>

  <label for="lastname">Last Name:</label>
  <input type="text" id="lastname" name="lastname" required>
  <br>

  <label for="age">Age:</label>
  <input type="number" id="age" name="age" required>
  <br>

  <label for="address">Address:</label>
  <textarea id="address" name="address" required></textarea>
  <br>

  <label for="province">Province:</label>
  <input type="text" id="province" name="province" required>
  <br>

  <label for="city">City:</label>
  <input type="text" id="city" name="city" required>
  <br>
  <label for="school">School:</label>
  <select id="school" name="school" required>
    <option value="">Select a school</option>
    <option value="Gapan">Gapan</option>
    <option value="Cabanatuan">Cabanatuan</option>
    <option value="Guimba">Guimba</option>
    <option value="San Jose">San Jose</option>
  </select>
  <br>
  <label for="barangay">Barangay:</label>
  <input type="text" id="barangay" name="barangay" required>
  <br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
  <br>

  <label for="contactnumber">Contact Number:</label>
  <input type="tel" id="contactnumber" name="contactnumber" required>
  <br>

  <input type="submit" value="Submit">
</form>
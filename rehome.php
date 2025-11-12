<?php
include 'db_connection.php'; // Connects to petmatch_db

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['petname'];
  $category = $_POST['pettype'];
  $age = $_POST['age'];
  $description = $_POST['desc'];
  $status = 'Available';  // So it appears in pet pages
  $price = 0;             // Always free

  // Handle image upload
  $imagePath = '';
  if (!empty($_FILES['photo']['name'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir);
    $imagePath = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $imagePath);
  }

  // Insert into the correct table (rehome)
  $sql = "INSERT INTO pets (name, category, age, description, price, status, image)
          VALUES ('$name', '$category', '$age', '$description', '$price', '$status', '$imagePath')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pet rehome listing posted successfully!'); window.location='rehome.php';</script>";
  } else {
    echo "<script>alert('Error saving pet: " . $conn->error . "');</script>";
  }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rehome a Pet — PetMatch</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* === REHOME PAGE DESIGN === */
    body {
      background-color: rgb(255, 115, 0); 
      font-family: 'Poppins', sans-serif;
      margin: 0;
      color: #333;
    }

    main {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 20px 10px;
    }

    .rehome-card {
      background: #fff;
      border-radius: 16px;
      padding: 80px;
      max-width: 600px;
      padding-bottom: 40px;
      padding-top: 0;
    }

    .section-title {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 10px;
      color: rgb(255, 115, 0)
    }

    .rehome-card img{
      background-repeat: no-repeat;
      background-position: center;
      width: 220px;
      justify-content: center;
      margin: 0 auto;  
      display: block;
      margin-bottom: 1px;  
      padding-bottom: 0px;
    }
    .rehome-card p {
      margin-top: 0;
      text-align: center;
      color: #666;
      margin-bottom: 25px;
      position: relative;
      z-index: 1; 
    }

    .rehome-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .rehome-form label {
      display: flex;
      flex-direction: column;
      font-weight: 500;
      color: #333;
    }

    .rehome-form input,
    .rehome-form select,
    .rehome-form textarea {
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      margin-top: 6px;
      transition: border-color 0.2s ease;
      font-family: 'Poppins', sans-serif;
    }

    .rehome-form input:focus,
    .rehome-form select:focus,
    .rehome-form textarea:focus {
      border-color: #ffa600ff;
      outline: none;
    }

    .rehome-form button {
      align-self: center;
      background: #0099ff;
      border: none;
      color: #fff;
      font-size: 16px;
      font-weight: 500;
      padding: 10px 22px;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .rehome-form button:hover {
      background: #007bcd;
    }

    .photo-preview img {
      display: block;
      max-width: 250px;
      margin-top: 10px;
      border-radius: 10px;
    }


  </style>
</head>
<body>
  <div class="container">
    <!-- HEADER -->
    <header>
      <div class="websitelogo"></div>
      <nav aria-label="Main navigation">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a class="primary" href="sellpet.php">Sell a Pet</a></li>
          <li><a class="primary" href="rehome.php">Rehome a Pet</a></li>
        </ul>
      </nav>
    </header>

    <!-- MAIN -->
    <main>
      <section id="rehome" aria-labelledby="rehome-head">
        <div class="rehome-card">
          <img src="uploads\eeae7a5b-dd5e-4a17-a053-438156c0a973.png" alt="">
          <h2 id="rehome-head" class="section-title">Post a Rehome Listing</h2>
          <p>List your pet for rehoming. All listings are for free adoption.</p>

          <form class="rehome-form" method="POST" enctype="multipart/form-data">
            <label>
              Pet Name:
              <input type="text" name="petname" required>
            </label>

            <label>
              Type of Pet:
              <select name="pettype" required>
                <option value="">Select type</option>
                <option>Dog</option>
                <option>Cat</option>
                <option>Bird</option>
                <option>Rabbit</option>
                <option>Fish</option>
                <option>Reptile</option>
              </select>
            </label>

            <label>
              Age:
              <input type="text" name="age" placeholder="e.g. 2 years">
            </label>

            <label>
              Description:
              <textarea name="desc" rows="3" placeholder="Describe your pet’s personality, needs, and habits"></textarea>
            </label>

            <label>
              Upload Photo:
              <input type="file" id="photoInput" name="photo" accept="image/*">
            </label>

            <div id="photoPreview" class="photo-preview"></div>

            <button type="submit" class="primary">Post Rehome Listing</button>
          </form>
        </div>
      </section>
    </main>

    <!-- FOOTER -->
    <footer>
      <div class="footer-container">
        <div class="brand-footer">
          <strong>Pawfect Match</strong>
          <div style="margin-top:6px; max-width:320px; color:#666; font-size:13px">
            A simple, humane marketplace for pets. Built with care for animals and people.
          </div>
        </div>
        <div class="contact">
          <div>Contact: hello@pawfectmatch.example</div>
          <div style="margin-top:8px;">© <span id="year"></span> Pawfect Match</div>
        </div>
      </div>
    </footer>
  </div>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();

    // Image preview
    const input = document.getElementById('photoInput');
    const preview = document.getElementById('photoPreview');
    input.addEventListener('change', () => {
      preview.innerHTML = '';
      const file = input.files[0];
      if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.alt = "Pet photo preview";
        preview.appendChild(img);
      }
    });
  </script>
</body>
</html>

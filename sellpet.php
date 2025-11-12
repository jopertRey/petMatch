<?php
include 'db_connection.php'; // Connects to petmatch_db

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['petname'];
  $category = $_POST['pettype'];
  $age = $_POST['age'];
  $description = $_POST['desc'];
  $price = $_POST['price'];
  $status = 'Available';

  // Handle image upload
  $imagePath = '';
  if (!empty($_FILES['photo']['name'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir);
    $imagePath = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $imagePath);
  }

  // Insert pet into database
  $sql = "INSERT INTO pets (name, category, age, description, price, status, image)
          VALUES ('$name', '$category', '$age', '$description', '$price', '$status', '$imagePath')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pet listing posted successfully!'); window.location='sellpet.php';</script>";
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
  <title>Sell a Pet — PetMatch</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* === SELL PAGE DESIGN (Copied from Rehome Page) === */
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
    .sell-card {
      background: #fff;
      border-radius: 16px;
      padding: 80px;
      max-width: 600px;
      padding-bottom: 40px;
      padding-top: 0;
      
    }
    .sell-card img{
      background-repeat: no-repeat;
      background-position: center;
      width: 220px;
      justify-content: center;
      margin: 0 auto;  
      display: block;
      margin-bottom: 1px;  
      padding-bottom: 0px;
    }
    .section-title {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 10px;
      color: rgb(255, 115, 0)
    }

    .sell-card p {
      margin-top: 0;
      text-align: center;
      color: #666;
      margin-bottom: 25px;
      position: relative;
      z-index: 1; 
    }

    .sell-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .sell-form label {
      display: flex;
      flex-direction: column;
      font-weight: 500;
      color: #333;
    }

    .sell-form input,
    .sell-form select,
    .sell-form textarea {
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      margin-top: 6px;
      transition: border-color 0.2s ease;
      font-family: 'Poppins', sans-serif;
    }

    .sell-form input:focus,
    .sell-form select:focus,
    .sell-form textarea:focus {
      border-color: #0099ff;
      outline: none;
    }

    .sell-form button {
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

    .sell-form button:hover {
      background: #007bcd;
    }

    .photo-preview img {
      display: block;
      max-width: 250px;
      margin-top: 10px;
      border-radius: 10px;
    }

    footer {
  background-color: white;
  padding: 20px 40px;
  color: #666;
  font-size: 15px;
  margin-top: 40px;
}
footer .brandfot {
  font-size: 20px;
  font-weight: 600;
  color: #0f0f0f;
  margin-bottom: 6px;
}
footer .footer-container {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  align-items: flex-start;

}
footer .brand-footer {
  
  align-items: center;  
  gap: 12px;
  text-decoration: none;

  color: #0f0f0f;
  min-width: 220px;
}
footer .contact {
  padding-top: 40px;
  margin-left: auto;
}

  </style>
</head>
<body>
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
      <section id="sell" aria-labelledby="sell-head">
        <div class="sell-card">
          <img src="uploads\eeae7a5b-dd5e-4a17-a053-438156c0a973.png" alt="">
          <h2 id="sell-head" class="section-title">Post a Pet for Sale</h2>
          <p>List your pet for sale and connect with potential adopters or buyers.</p>

          <form class="sell-form" method="POST" enctype="multipart/form-data">
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
              <input type="text" name="age" placeholder="e.g. 1 year">
            </label>

            <label>
              Description:
              <textarea name="desc" rows="3" placeholder="Describe your pet’s personality, needs, or habits"></textarea>
            </label>

            <label>
              Price (₱):
              <input type="number" name="price" min="0" placeholder="Enter price in PHP">
            </label>

            <label>
              Upload Photo:
              <input type="file" id="photoInput" name="photo" accept="image/*">
            </label>

            <div id="photoPreview" class="photo-preview"></div>

            <button type="submit" class="primary">Post Pet for Sale</button>
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

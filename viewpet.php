<?php
include 'db_connection.php'; // make sure this file has your connection code

// Get pet ID from URL (e.g., viewpet.php?id=3)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM pets WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $pet = $result->fetch_assoc();
} else {
  $pet = null;
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Pet — PetMatch</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background:  #ff751a;
    }
    .view-pet {
      max-width: 900px;
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      margin-top: 130px;
      color: black;
    }
    .view-pet img {
      width: 100%;
      max-width: 400px;
      border-radius: 12px;
      object-fit: cover;
    }
    .view-pet h2{
      text-align: center;
    }
    .pet-info {
      flex: 1;
      min-width: 250px;
      font-weight: 100;
      font-family: Poppins, sans-serif;
    }
    .status {
      font-weight: bold;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 0.9em;
    }
    .available { background: #d4f8d4; color: #1a7e1a; }
    .soldout { background: #ffe4e4; color: #d22; }
    .price {
      font-size: 1.4em;
      color: #0099ff;
      font-weight: bold;
      margin: 10px 0;
    }
    .contact-btn {
      background: #ff751a;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px 16px;
      cursor: pointer;
      font-size: 1em;
      font-family: Poppins, sans-serif; 
      text-align: center;
      margin-left: 140px;
    }
    .popup {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
    }
    .popup-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.2);
      color: #ff751a;
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-family: Poppins, sans-serif;
    }
    .popup-content textarea {
      width: 100%;
      height: 100px;
      margin-bottom: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      padding: 8px;
      resize: none;
      font-family: Poppins, sans-serif;
    }
    .popup-content button {
      background: #ff751a;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 8px 14px;
      cursor: pointer;
    }
    .popup-content button:hover {
      background: #e06500;
    } 
    .popup-content h3 {
      margin-top: 20px;
      text-align: center;
    }
    .back {
      gap: 20px;
      width: 80px;
      height: 40px;
      border-radius: 10px;
      background: linear-gradient(135deg, #d6eaff, #0099ff);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: white;
      text-decoration: none;
    }


    nav ul li a{
    background: #ff751a;
    color: #ffffff;
    padding: 8px 18px;
    border-radius: 20px;
    margin-left: 5px;
    font-weight: 500;
    transition: background 0.3s;  
    fontfamily: Poppins, sans-serif;
}
  </style>
</head>
<body>
  <header>
      <div class="websitelogo"></div>
      <nav aria-label="Main navigation">
        <ul>
          <li><a href="home.php">Home</a></li>
        </ul>
      </nav>
  </header>

  <section class="view-pet">
    <?php if ($pet): ?>
      <img src="<?= htmlspecialchars($pet['image']) ?>" alt="<?= htmlspecialchars($pet['name']) ?>">
      <div class="pet-info">
        <h2><?= htmlspecialchars($pet['name']) ?></h2>
        <p><?= htmlspecialchars($pet['age']) ?> • <?= htmlspecialchars($pet['gender']) ?></p>
        <p class="price">₱<?= htmlspecialchars($pet['price']) ?></p>
        <span class="status <?= strtolower($pet['status']) === 'available' ? 'available' : 'soldout' ?>">
          <?= htmlspecialchars($pet['status']) ?>
        </span>
        <p style="margin-top:10px;"><?= htmlspecialchars($pet['description']) ?></p>
        <button class="contact-btn" id="contactSeller">Contact Seller</button>
      </div>
    <?php else: ?>
      <p>Pet not found. <a href="home.html">Go back</a>.</p>
    <?php endif; ?>
  </section>

  <div class="popup" id="messagePopup">
    <div class="popup-content">
      <h3>Message Seller</h3>
      <textarea placeholder="Write your message here..."></textarea>
      <div style="text-align:right;">
        <button id="sendMsg">Send</button>
        <button id="closePopup" style="background:#ccc; color:#000;">Close</button>
      </div>
    </div>
  </div>

  <script>
    const popup = document.getElementById('messagePopup');
    const sendBtn = document.getElementById('sendMsg');
    const closeBtn = document.getElementById('closePopup');

    document.body.addEventListener('click', (e) => {
      if (e.target.id === 'contactSeller') popup.style.display = 'flex';
    });

    closeBtn.onclick = () => popup.style.display = 'none';
    sendBtn.onclick = () => {
      alert('Your message has been sent (demo only).');
      popup.style.display = 'none';
    };
  </script>
</body>
</html>

<?php
include 'db_connection.php';

// Fetch all rabbits from the database
$sql = "SELECT * FROM pets WHERE category='Rabbit'";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PetMatch — Rabbits</title>
  <meta name="description" content="Discover adorable rabbits available for sale or adoption at Pawfect Match." />
  <link rel="stylesheet" href="style.css">
  <style>
    .hidden { display: none; }
    .filter-btn {
      font-family: 'Poppins', sans-serif;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      cursor: pointer;
      transition: background 0.2s;
      font-weight: 400;
      background: transparent;
      color: #ffffffff;
      border-radius: 20px;     
      border: 2px solid white;
    }
    .filter-btn.active {
      background: #ffd900ff;
      color: black;
    }
    .rabbit-buttons {
      display: flex;
      gap: 10px;
      justify-content: center;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- HEADER -->
    <header>
  <div class="left-side-nav"> 
    <a href="home.php" class="brand" aria-label="PetMatch homepage">
      <div class="websitelogo"></div>
      </a>

    <nav aria-label="Main navigation">
      <ul>
        <li><a href="#listings">Pets</a></li>
        <li><a class="primary" href="sellpet.php">Sell a pet</a></li>
        <li><a class="primary" href="rehome.php">Rehome a pet</a></li>
      </ul>
    </nav>
  </div>

  <nav aria-label="User authentication"> 
    <ul>
      <li><a href="#" class="login-btn" onclick="openModal('loginModal')">Login</a></li>
      <li><a href="#" class="signup-btn" onclick="openModal('signupModal')">Sign Up</a></li>
    </ul>
  </nav>
</header>

    <!-- SEARCH -->
    <form class="search" role="search" aria-label="Search rabbits">
      <input type="search" name="q" placeholder="Search by breed, age, or location — e.g. 'Holland Lop Manila'" aria-label="Search rabbits">
      <button type="submit">Search</button>
    </form>

    <!-- TOP CATEGORIES -->
    <div class="topcategories">
      <a href="dog.php">Dogs</a>
      <a href="cat.php">Cats</a>
      <a href="bird.php">Birds</a>
      <a href="rabbit.php" class="active">Rabbits</a>
      <a href="fish.php">Fish</a>
      <a href="reptiles.php">Reptiles</a>
    </div>

    <!-- HERO SECTION -->
    <section class="hero hero-rabbit" aria-labelledby="hero-head">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 id="hero-head">Cuddly Rabbits Waiting for a Home 🐇</h1>
        <p>Whether you're adopting or shopping, find your perfect fluffy friend here.</p>
      </div>
    </section>

    <!-- LISTINGS -->
    <section id="listings" aria-labelledby="list-head">
      <h2 id="list-head" class="section-title">Rabbit Listings</h2>

      <div class="rabbit-buttons">
        <button id="showShop" class="filter-btn active">Shop</button>
        <button id="showAdopt" class="filter-btn">Adoptable</button>
      </div>

      <div class="grid" id="rabbitGrid">
        <?php
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $statusLower = strtolower((string)$row['status']);
            $type = (float)$row['price'] === 0.0 || strpos($statusLower, 'adopt') !== false ? "adoptable" : "shop";
            $img = !empty($row['image']) ? $row['image'] : 'uploads/default-pet.jpg';

            echo "
              <article class='card {$type}' aria-label='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'>
                <img src='" . htmlspecialchars($img, ENT_QUOTES) . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'>
                <h3>" . htmlspecialchars($row['name'], ENT_QUOTES) . "</h3>
                <p>" . htmlspecialchars($row['age'], ENT_QUOTES) . " • " . htmlspecialchars($row['gender'], ENT_QUOTES) . " • " . htmlspecialchars($row['breed'], ENT_QUOTES) . "</p>
                <div class='meta'>
                  <span class='price'>" . (($row['price'] == 0) ? "Adoptable" : "₱" . number_format($row['price'], 2)) . "</span>
                  <a href='viewpet.php?id=" . urlencode($row['id']) . "'>View</a>
                </div>
              </article>
            ";
          }
        } else {
          echo "<p style='text-align:center;color:#666;'>No rabbits found in the database.</p>";
        }
        ?>
      </div>
    </section>

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

    const adoptBtn = document.getElementById('showAdopt');
    const shopBtn = document.getElementById('showShop');

    function getCards() {
      return {
        adoptable: Array.from(document.querySelectorAll('.adoptable')),
        shop: Array.from(document.querySelectorAll('.shop'))
      };
    }

    function showShopOnly() {
      const cards = getCards();
      shopBtn.classList.add('active');
      adoptBtn.classList.remove('active');
      cards.shop.forEach(c => c.style.display = 'block');
      cards.adoptable.forEach(c => c.style.display = 'none');
    }

    function showAdoptOnly() {
      const cards = getCards();
      adoptBtn.classList.add('active');
      shopBtn.classList.remove('active');
      cards.adoptable.forEach(c => c.style.display = 'block');
      cards.shop.forEach(c => c.style.display = 'none');
    }

    adoptBtn.addEventListener('click', showAdoptOnly);
    shopBtn.addEventListener('click', showShopOnly);

    // Default view — show only shop rabbits
    document.addEventListener('DOMContentLoaded', showShopOnly);
  </script>
</body>
</html>

<?php $conn->close(); ?>

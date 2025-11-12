<?php
include 'db_connection.php';

// Fetch 6 newest pets
$sql = "SELECT * FROM pets ORDER BY date_posted DESC LIMIT 6";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PetMatch — Buy, Sell & Rehome Pets</title>
  <meta name="description" content="PetMatch — a friendly marketplace to buy, sell, and rehome pets (dogs, cats, birds, hamsters)." />
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="uploads/LogoFR.png">
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
          <li><a href="#" class="login-btn" onclick="openContainer('loginForm')">Login</a></li>
          <li><a href="#" class="signup-btn" onclick="openContainer('signupForm')">Sign Up</a></li>
        </ul>
      </nav>
    </header>

    <!-- SEARCH -->
    <form class="search" role="search" aria-label="Search pets">
      <input type="search" name="q" placeholder="Search by type, breed, or location — e.g. 'golden retriever manila'" aria-label="Search pets">
      <button type="submit">Search</button>
    </form>

    <!-- TOP CATEGORIES -->
    <div class="topcategories">
      <a href="dog.php">Dogs</a>
      <a href="cat.php">Cats</a>
      <a href="bird.php">Birds</a>
      <a href="rabbit.php">Rabbits</a>
      <a href="fish.php">Fish</a>
      <a href="reptiles.php">Reptiles</a>
    </div>

    <!-- HERO -->
    <section class="hero" aria-labelledby="hero-head">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 id="hero-head">Find your new furry (or feathery) friend today</h1>
        <p>Browse pets near you, connect safely with sellers & rescues, and discover your perfect companion.</p>
      </div>
    </section>

    <!-- NEW ARRIVALS -->
    <section id="listings" aria-labelledby="list-head">
      <h2 class="section-title" id="list-head"> - - - - New Arrivals - - - -</h2>
      <div class="grid">
        <?php
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $img = !empty($row['image']) ? $row['image'] : 'uploads/default-pet.jpg';
            $priceText = ($row['price'] == 0 || strtolower($row['status']) === 'adoptable') 
              ? 'Adoptable' 
              : '₱' . number_format($row['price'], 2);

            echo "
            <article class='card'>
              <img src='" . htmlspecialchars($img, ENT_QUOTES) . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'>
              <h3>" . htmlspecialchars($row['name'], ENT_QUOTES) . "</h3>
              <p>" . htmlspecialchars($row['age'], ENT_QUOTES) . " • " . htmlspecialchars($row['gender'], ENT_QUOTES) . " • " . htmlspecialchars($row['breed'], ENT_QUOTES) . "</p>
              <div class='meta'>
                <span class='price'>" . htmlspecialchars($priceText, ENT_QUOTES) . "</span>
                <a href='viewpet.php?id=" . urlencode($row['id']) . "'>View</a>
              </div>
            </article>";
          }
        } else {
          echo "<p style='text-align:center;color:#666;'>No pets added yet.</p>";
        }
        ?>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how-it-works">
      <h2 class="section-title">How it works</h2>
      <ol>
        <li>Search or create a listing with clear photos and vet records.</li>
        <li>Message the seller, arrange a safe meeting or video call.</li>
        <li>Complete the sale/adoption and share feedback.</li>
      </ol>
    </section>

    <!-- LOGIN POPUP -->
    <div id="loginForm" class="popup-overlay" aria-hidden="true">
      <div class="form-box" role="dialog" aria-modal="true" aria-labelledby="loginTitle">
        <span class="close" onclick="closeContainer('loginForm')" aria-label="Close">&times;</span>

        <form action="login.php" method="POST">
          <h2 id="loginTitle" style="text-align:center; color:#ff7a00;">Login</h2>
          <input type="email" id="loginEmail" name="email" placeholder="Email" required>
          <input type="password" id="loginPassword" name="password" placeholder="Password" required>

          <div class="form-row">
            <input type="checkbox" id="showLoginPass">
            <label for="showLoginPass">Show Password</label>
          </div>

          <button type="submit" name="login" class="auth-btn">Login</button>
          <p style="text-align:center; margin-top:12px;">Don't have an account? 
            <a href="#" onclick="openContainer('signupForm'); closeContainer('loginForm')">Register</a>
          </p>
        </form>
      </div>
    </div>

    <!-- SIGNUP POPUP -->
    <div id="signupForm" class="popup-overlay" aria-hidden="true">
      <div class="form-box" role="dialog" aria-modal="true" aria-labelledby="signupTitle">
        <span class="close" onclick="closeContainer('signupForm')" aria-label="Close">&times;</span>

        <form action="signup.php" method="POST">
          <h2 id="signupTitle" style="text-align:center; color:#ff7a00;">Sign Up</h2>
            <select name="role" id="">
              <option value="" disabled selected>Select Role</option>
              <option value="userAcc">User</option>
              <option value="adminAcc">Admin</option>
            </select>
          <input type="text" id="signupFirst" name="firstname" placeholder="First Name" required>
          <input type="text" id="signupLast" name="lastname" placeholder="Last Name" required>
          <input type="email" id="signupEmail" name="email" placeholder="Email" required>
          <input type="password" id="signupPassword" name="password" placeholder="Password" required>
          
          
          <div class="form-row">
            <input type="checkbox" id="showSignupPass">
            <label for="showSignupPass">Show Password</label>
          </div>

          <button type="submit" name="signup" class="auth-btn">Sign Up</button>
          <p style="text-align:center; margin-top:12px;">Already have an account? 
            <a href="#" onclick="openContainer('loginForm'); closeContainer('signupForm')">Login</a>
          </p>
        </form>
      </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
      function openContainer(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.display = 'flex';
        el.setAttribute('aria-hidden', 'false');
      }

      function closeContainer(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.display = 'none';
        el.setAttribute('aria-hidden', 'true');
      }

      window.addEventListener('click', function(event) {
        if (event.target.classList.contains('popup-overlay')) {
          closeContainer(event.target.id);
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('showLoginPass').addEventListener('change', function() {
          document.getElementById('loginPassword').type = this.checked ? 'text' : 'password';
        });
        document.getElementById('showSignupPass').addEventListener('change', function() {
          document.getElementById('signupPassword').type = this.checked ? 'text' : 'password';
        });
      });
    </script>

    <!-- FOOTER -->
    <footer>
      <div class="footer-container">
        <div class="brand-footer">
          <p class="brandfot">PetMatch</p>
          <div style="margin-top:6px; max-width:320px; color:#666;">
            A simple, humane marketplace for pets. Built with care.
          </div>
        </div>
        <div class="contact">
          <div>Contact: PetMatchhub.com</div>
          <div style="margin-top:8px;">© <span id="year"></span> PetMatch</div>
        </div>
      </div>
    </footer>

  </div>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>

<?php $conn->close(); ?>

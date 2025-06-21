<?php
// Start session at the very beginning
session_start();

// Include the database connection
require_once('db_connection.php');

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AD IN CS - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 0.6s ease-out; }
    .nav-link:hover { transform: translateY(-2px); transition: transform 0.2s ease-in-out; }
    .hero-image {
      object-fit: cover; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
      display: block; margin-left: auto; margin-right: auto; width: 600px; height: 337.5px;
    }
    .gallery-image {
      width: 100%; height: 16rem; object-fit: cover; border-radius: 0.5rem;
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s;
    }
    .gallery-image:hover { transform: scale(1.05); }
    .welcome-message {
      background-color: rgba(0, 0, 0, 0.7); color: white; padding: 0.5rem 1rem;
      border-radius: 0.5rem; margin-left: 1rem;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">
  <nav class="bg-indigo-900 text-white sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="text-2xl font-bold">AD IN CS</div>
        <div class="flex space-x-6 items-center">
          <a href="index.php" class="nav-link px-3 py-2 rounded-md bg-indigo-700">Home</a>
          <a href="about.php" class="nav-link px-3 py-2 rounded-md hover:bg-indigo-700 transition">About</a>
          <a href="services.php" class="nav-link px-3 py-2 rounded-md hover:bg-indigo-700 transition">Services</a>
          <a href="consultation.php" class="nav-link px-3 py-2 rounded-md hover:bg-indigo-700 transition">Consultation</a>
          <?php if (!isset($_SESSION['username'])): ?>
            <a href="register.php" class="nav-link px-3 py-2 rounded-md hover:bg-indigo-700 transition">Signup</a>
            <a href="login.php" class="nav-link px-3 py-2 rounded-md hover:bg-indigo-700 transition">Login</a>
          <?php else: ?>
            <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="nav-link px-3 py-2 rounded-md hover:bg-red-600 bg-red-500 transition">Logout</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
      <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Anomaly Detection in Cyber Security</h1>
        <p class="text-lg text-gray-600 mb-6">Protect your organization with cutting-edge anomaly detection solutions.</p>
        <div class="flex flex-col md:flex-row justify-center items-center gap-6">
          <img src="AI.png" alt="AI-Powered Anomaly Detection" class="w-72 h-auto rounded-lg shadow-lg fade-in">
          <img src="process.png" alt="Anomaly Detection Process" class="w-72 h-auto rounded-lg shadow-lg fade-in">
        </div>
      </div>

      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Explore Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="fade-in">
            <img src="r.jpg" alt="Real-Time Monitoring" class="gallery-image">
            <p class="text-center text-gray-700 font-semibold mt-2">Real-Time Monitoring</p>
          </div>
          <div class="fade-in">
            <img src="f.png" alt="Fraud Detection" class="gallery-image">
            <p class="text-center text-gray-700 font-semibold mt-2">Fraud Detection</p>
          </div>
          <div class="fade-in">
            <img src="e.png" alt="Employee Insights" class="gallery-image">
            <p class="text-center text-gray-700 font-semibold mt-2">Employee Insights</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-gray-800 text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>© 2025 AD IN CS. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
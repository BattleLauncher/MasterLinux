<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Promotion Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f9ff;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #0077b6;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            color: #fff;
            font-size: 1.5rem;
        }

        .nav-links {
            position: relative;
        }

        .dropdown {
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            display: none;
            position: absolute;
            top: 2.5rem;
            right: 0;
            min-width: 180px;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
        }

        .dropdown a:hover {
            background: #0077b6;
            color: #fff;
        }

        .nav-links button {
            background: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }

        .nav-links:hover .dropdown {
            display: block;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(to right, #0d90ed, #90ee90);
            color: #fff;
        }

        .hero h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        /* About Section */
        .about {
            padding: 3rem 2rem;
            max-width: 900px;
            margin: auto;
            text-align: center;
        }

        .about h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #0077b6;
        }

        .about p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #444;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h1>Promotion Platform</h1>
        <div class="nav-links">
            <button>Login ▼</button>
            <div class="dropdown">
                <a href="../customer/view/login.php">Customer Login</a>
                <a href="../promoter/view/login.php">Promoter Login</a>
                <a href="../admin/view/login.php">Admin Login</a>

            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <h2>Welcome to the Promotion Platform</h2>
        <p>Connecting businesses with promoters and customers</p>
    </div>

    <!-- About Section -->
    <div class="about">
        <h2>About Us</h2>
        <p>
            Our platform helps businesses grow by connecting them with promoters who act like celebrities. 
            As a promoter, you can represent a brand, build awareness, and bring in new customers. 
            Businesses can showcase their products or services, while promoters use their influence 
            to create trust and engagement. It's a win-win: customers discover new brands, and businesses 
            reach wider audiences through powerful promotions.
        </p>
    </div>
</body>
</html>

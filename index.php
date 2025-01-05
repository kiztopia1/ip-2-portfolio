<?php
session_start();
include 'includes/include.inc.php';

$controller = new Controller();

// Fetch website content
$websiteResult = $controller->readWebsiteContent();
$websiteData = $websiteResult->fetch_assoc(); // Fetch as associative array

$name = $websiteData['name'] ?? 'Your Name'; // Default value if no data exists
$about = $websiteData['about'] ?? 'Welcome to my portfolio!';

// Fetch project content
$projectResult = $controller->readProjectContent();

// Fetch contact information
$email = $websiteData['email'] ?? 'your-email@example.com';
$phone = $websiteData['phone'] ?? 'Your Phone Number';

// Fetch services content
$servicesResult = $controller->readServicesContent();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Portfolio</title>
    <style>
        .progress-bar {
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            width: 100%;
            height: 20px;
            margin: 10px 0;
        }
        .progress-bar-fill {
            background-color: #4caf50;
            height: 100%;
            width: 0%;
            text-align: center;
            line-height: 20px;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav>
      <ul>
        <li><a href="./projects.html">Projects</a></li>
        <li><a href="./contact.html">Contact</a></li>
        <li><a href="https://github.com/kiztopia1/">GitHub</a></li>
      </ul>
    </nav>

    <div class="hero">
        <div class="left">
            <h1>Hi, It's <?php echo htmlspecialchars($name); ?>. Nice to meet you!</h1>
            <p><?php echo $about; ?></p>
        </div>
        <img src="./images/profile.jpg" alt="Profile Image" class="profile" />
        <div class="right">
            <img src="./images/hero.svg" alt="Hero Image" />
        </div>
    </div>
    
    <div class="projects">
        <section>
            <h2>Main Projects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($project = $projectResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                            <td><?php echo htmlspecialchars($project['description']); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($project['imageurl']); ?>">
                                    <img src="./images/<?php echo htmlspecialchars($project['imageurl']); ?>" alt="<?php echo htmlspecialchars($project['project_name']); ?>" />
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <div class="services">
        <section>
            <h2>Skills</h2>
            <?php while ($service = $servicesResult->fetch_assoc()): ?>
                <div class="service-item">
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: <?php echo htmlspecialchars($service['level']); ?>%;">
                            <?php echo htmlspecialchars($service['level']); ?>%
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    </div>
    
    <div class="contact">
        <section>
            <h2>Contact Information</h2>
            <p>
                Feel free to reach out to me via email or connect with me on social media:
            </p>
            <ul>
                <li>Email: <a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></li>
                <li>Phone: <?php echo htmlspecialchars($phone); ?></li>
                <!-- Add more social media links dynamically if needed -->
            </ul>
        </section>
    </div>
</body>
</html>

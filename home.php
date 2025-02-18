<?php 
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}

$id = $_SESSION['unique_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$content = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Verse WebApp (Home)</title>
    <link rel="shortcut icon" href="php/images/freepik__background__64824.png" type="">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    
     <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
 
 
<script>

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('post').addEventListener('click', function() {
        const formContainer = document.getElementById('postcontainer');
        if (formContainer.style.display === 'block') {
            formContainer.style.display = 'none';
        } else {
            formContainer.style.display = 'block';
        }
    });
});



    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('message').addEventListener('click', function() {
        const formContainer = document.getElementById('messagediv');
        if (formContainer.style.display === 'block') {
            formContainer.style.display = 'none';
        } else {
            formContainer.style.display = 'block';
        }
    });
});


    function toggleForm() {
        var form = document.getElementById('formContainer');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function toggleIcon(icon) {
        if (icon.classList.contains('bi-heart')) {
            icon.classList.replace('bi-heart', 'bi-heart-fill');
        } else {
            icon.classList.replace('bi-heart-fill', 'bi-heart');
        }
    }
    
</script>

 
 <style>

        #postcontainer {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            z-index: 9999;
        }

        .form-control {
            border-radius: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .btn-post {
            background-color: #28a745;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
        }

        .btn-post:hover {
            background-color: #218838;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

  #messagediv {
    position: fixed;
    top: 100px; /* Adjust to position below the navbar */
    right: 20px;
    display:none; /* Hidden by default */
    z-index: 9999;
  }
    .wrapper {
      max-width: 600px;
      margin: 20px auto;
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .users .content img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    .users .content .details {
      margin-left: 10px;
    }
    .users .content {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .search input {
      border-radius: 20px;
    
    }
    .logout {
      background: #dc3545;
      color: white;
      border-radius: 20px;
      padding: 5px 15px;
      text-decoration: none;
    }
    .logout:hover {
      background: #c82333;
    }
.users header,
.users-list a{
  display: flex;
  align-items: center;
  padding-bottom: 20px;
  border-bottom: 1px solid black;
  justify-content: space-between;
  text-decoration: none; 
}
.wrapper img{
  object-fit: cover;
  border-radius: 50%;
}
.users header img{
  height: 50px;
  width: 50px;
}
:is(.users, .users-list) .content{
  display: flex;
  align-items: center;
}
:is(.users, .users-list) .content .details{
  color: #000;
  margin-left: 20px;
}
:is(.users, .users-list) .details span{
  font-size: 18px;
  font-weight: 500;
}
        #formContainer {
            display: none;
            position: absolute;
            top: 80px;
            left: 10px;
            z-index: 9999;
            width: 100%;
            max-width: 340px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .mb-3 .col-form-label {
            text-align: left;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        /* Styling for smaller screens */
        @media (max-width: 576px) {
            .navbar-brand img {
                width: 45px;
                height: 45px;
            }

            .input-group img {
                width: 35px;
                height: 35px;
            }

            .card-header img {
                width: 40px;
                height: 40px;
            }

            #profileImage {
                width: 80px;
                height: 80px;
            }
        }

        /* Responsive adjustments for large screens */
        @media (min-width: 768px) {
            .input-group {
                width: 60%;
            }
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>

<body style="background-color: #f4f4f4;">
<?php foreach ($content as $item): ?>
    <?php  
    $imagePath = 'php/images/' . htmlspecialchars($item['img']);
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#" onclick="toggleForm()">
                <img src="<?php echo $imagePath; ?>" alt="Profile Picture" class="rounded-circle me-3" style="width: 60px; height: 60px;">
                <div>
                    <h5 class="mb-0"><?php echo htmlspecialchars($item['fname'] . ' ' . $item['lname']); ?></h5>
                    <p class="mb-0 text-muted">@<?php echo htmlspecialchars($item['fname']); ?></p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" id="post">Add Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" id="message">Messages</a></li>
                    <li class="nav-item"><a class="nav-link">Settings</a></li>
                   <li class="nav-item"><a class="nav-link" href="php/logout.php?logout_id=<?php echo $item['unique_id']; ?>">Logout</a></li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Input Group -->
    <div class="d-flex justify-content-center mt-4">
        <div class="input-group w-50">
            <img src="<?php echo $imagePath; ?>" alt="Profile Picture" class="rounded-circle me-3" style="width: 45px; height: 45px;">
            <input type="text" class="form-control me-2" placeholder="What's on your mind?" aria-label="Post">
            <button class="btn btn-outline-success" type="submit">Post</button>
        </div>
    </div>

    
<!-- Post Form (Initially Hidden) -->
<div id="postcontainer">
    <form id="postForm" method="POST" enctype="multipart/form-data"  onsubmit="submitForm(event)">
        <h4>Create Post</h4>
        <div class="form-group">
            <textarea class="form-control" name="content" rows="4" placeholder="What's on your mind?" required></textarea>
        </div>
        <div class="form-group">
            <label for="imageUpload" class="btn btn-outline-secondary">Upload Image</label>
            <input type="file" name="image" id="imageUpload" class="form-control" style="display: none;" onchange="previewImage(event)">
        <input type="hidden" id="user_id" value="<?php echo htmlspecialchars($item['user_id']);?>" name="user_id">
        </div>
        <div class="form-group">
            <img id="profileImage" src="#" alt="Image Preview" class="img-thumbnail" style="max-width: 100%; max-height: 200px; display: none;">
        </div>
        <button class="btn btn-outline-success" type="submit">Post</button>
        </form>
</div>


<script>
document.querySelector('#imageUpload').addEventListener('change', previewImage);

function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        const imageElement = document.getElementById('profileImage');
        imageElement.src = e.target.result;
        imageElement.style.display = 'block';  // Make the image visible
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}

        // Function to handle form submission via AJAX
        function submitForm(event) {
            event.preventDefault();  // Prevent the default form submission

            var formData = new FormData(document.getElementById('postForm'));

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Set up the request
            xhr.open('POST', 'post_submit.php', true);

            // Set up the callback function to handle the response
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);  // Parse the JSON response

                    // Display success or error message based on response status
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();

                    } else {
                        alert('Error: ' + response.message);  // Error alert
                    }
                } else {
                    alert('Error: Unable to reach the server.');
                }
            };

            // Send the form data to the server
            xhr.send(formData);
        }
    </script>
    <div id="messagediv">
    <div class="wrapper">
        <section class="users">
            <!-- Header Section with User Info -->
            <header class="d-flex justify-content-between align-items-center bg-light p-3 rounded shadow-sm">
                <div class="content d-flex align-items-center">
                    <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                      <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
                </div>
                <a href="home.php" class="btn btn-danger btn-sm">Close
</a>
            </header>

            <!-- Search Section -->
            <div class="search mt-3">
                <span class="text-muted d-block mb-2">Select a user to start chat</span>
                <div class="input-group">
                    <input type="text" placeholder="Enter name" class="form-control rounded-start" aria-label="Search for users">
                    <button class="btn btn-primary rounded-end"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <!-- Users List -->
            <div class="users-list mt-3">
                <!-- Users will be dynamically populated here -->
            </div>
        </section>
    </div>
</div>

<script src="javascript/users.js"></script>


    <?php
// SQL query to fetch posts and user details
$sql = "SELECT 
            p.post_id, 
            p.content, 
            p.image, 
            p.created_at, 
            u.fname, 
            u.lname, 
            u.img AS user_image, 
            u.email
        FROM posts p
        JOIN users u ON p.user_id = u.user_id
        ORDER BY p.created_at DESC";  // Order by the latest post first

// Execute query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Loop through the posts
    while ($post = $result->fetch_assoc()) {
      
        $imagePath1 = 'php/images/' . htmlspecialchars($post['user_image']);        // Display each post

        $fname = htmlspecialchars($post['fname']);
        $lname = htmlspecialchars($post['lname']);
        $content = htmlspecialchars($post['content']);
        $created_at = $post['created_at'];  
        $imagepost = 'php/images/' . htmlspecialchars($post['image']);        // Display each post
        echo '
        <div class="container mt-5">
            <div class="card mx-auto" style="max-width: 600px; border-radius: 10px;">
                <div class="card-header bg-white border-0 d-flex align-items-center">
                    <img src="' . $imagePath1 . '" alt="Profile Picture" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="mb-0">' . $fname . ' ' . $lname . '</h6>
                        <small class="text-muted">@' . $fname . ' • ' . date('h:i A', strtotime($created_at)) . '</small>
                    </div>
                </div>';
                
        // If the post has an image, display it
        if ($imagepost) {
            echo '<img src="' . $imagepost . '" class="card-img-top" alt="Post Image" style="border-radius: 0;">';
        }

        echo '
                <div class="card-body">
                    <p class="card-text"><strong>' . $fname . '</strong> ' . $content . '</p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-around">
                    <i class="bi bi-heart icon-clickable" onclick="toggleIcon(this)"></i>
                    <i class="bi bi-chat-left-text icon-clickable"></i>
                    <i class="bi bi-share icon-clickable"></i>
                </div>
            </div>
        </div>';
    }
} else {
    echo "";
}
?>


     <!-- Edit Profile Form -->
     <div class="container mt-4" id="formContainer">
        <div class="col-md-8 mx-auto">
            <h2>Edit Profile</h2>
            <form action="updateuser.php" method="post" enctype="multipart/form-data">
            <div class="card-header bg-white border-0 text-center">
        <img id="profileImage" src="<?php echo $imagePath; ?>" alt="Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('fileInput').click();">
        <input type="file" id="fileInput" name="profileImage" style="display:none;">
        </div>

    <!-- Form Sections -->
    <div class="mb-4 row">
        <label for="username" class="col-form-label">Username</label>
        <div class="col">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item['username'])?>" id="username" name="username" placeholder="Username">
        </div>
    </div>

    <div class="mb-4 row">
        <label for="name" class="col-form-label"> First Name</label>
        <div class="col">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item['fname'] );?>" id="name" name="fname" placeholder="Recipient's Name">
        </div>
    </div>
    <div class="mb-4 row">
        <label for="name" class="col-form-label"> Last Name</label>
        <div class="col">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item['lname'] );?>" id="name" name="lname" placeholder="Recipient's Name">
        </div>
    </div>

    <div class="mb-4 row">
        <label for="url" class="col-form-label">Add URL</label>
        <div class="col">
            <input type="text" class="form-control" id="url" value="<?php echo htmlspecialchars($item['url']);?>" name="url" placeholder="URL">
        </div>
    </div>

    <div class="mb-4 row">
        <label for="pronouns" class="col-form-label">Pronouns</label>
        <div class="col">
            <input type="text" class="form-control" id="pronouns"  value="<?php echo htmlspecialchars($item['pronouns']);?>" name="pronouns" placeholder="Pronouns">
        </div>
    </div>

    <div class="mb-4 row">
    <label for="bio" class="col-form-label">Bio</label>
    <div class="col">
        <textarea class="form-control" id="bio" name="bio" placeholder="Short bio"><?php echo htmlspecialchars($item['bio']); ?></textarea>
    </div>
</div>

<!-- Gender Selection -->
<div class="mb-4 row">
    <label for="gender" class="col-form-label">Gender</label>
    <div class="col">
        <select class="form-control" id="gender" name="gender">
            <option value="male" <?php echo ($item['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($item['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
        </select>
    </div>
</div>

    <div class="mb-4 row">
        <input class="btn btn-outline-success" type="submit" value="ADD">
</div>

</form>


<?php endforeach; ?>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
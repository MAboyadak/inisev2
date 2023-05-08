<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/inisev2/assets/style.css">
    <title>Document</title>
</head>
<body>
    <?php if(isAuthenticated()) { ;?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="/inisev2">Notice Board</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/inisev2/pages/notice-board.php">Messages</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/inisev2/pages/add-message.php">Add Message</a>
              </li>
              <li class="nav-item">
                  <form action="/inisev2/controllers/logoutcontroller.php" method="POST">
                      <button type="submit" class="nav-link btn">Logout</button>
                  </form>        
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php } ?>

<div class="container mt-5">

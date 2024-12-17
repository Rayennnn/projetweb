<?php
//require_once '../app/require.php';

// URL routing logic here
$url = isset($_GET['url']) ? $_GET['url'] : '';
// Route to appropriate controller

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/footer.css" />
  <link rel="stylesheet" href="./styles/components.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row border-top px-xl-5">
      <div class="col-lg- ml-auto mr-auto d-none d-lg-block">
        <img
          href="index.html"
          class="img-fluid"
          src="img/logo.png"
          width="50"
          height="50"
          alt="" />
      </div>
      <div class="col-lg-9">
        <nav
          class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
          <a href="" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
          </a>
          <button
            type="button"
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-between"
            id="navbarCollapse">
            <div class="navbar-nav py-0">
              <a href="index.html" class="nav-item nav-link">accueil </a>
              <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-toggle="dropdown">internationale</a>
                <div class="dropdown-menu rounded-0 m-0">
                  <a href="blog.html" class="dropdown-item">bourse d'étude</a>
                  <a href="single.html" class="dropdown-item">programme d'échange</a>
                </div>
              </div>
              <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-toggle="dropdown">activite</a>
                <div class="dropdown-menu rounded-0 m-0">
                  <a href="blog.html" class="dropdown-item">club</a>
                  <a href="single.html" class="dropdown-item">formation</a>
                </div>
              </div>
              <a href="course.html" class="nav-item nav-link">quiz</a>

              <a href="teacher.html" class="nav-item nav-link">témoiniage</a>
              <a href="contact.html" class="nav-item nav-link active">Contact</a>
            </div>
            <a
              class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block"
              href="signup.html">Sign in</a>
            <a
              class="btn btn-primary py-2 px-4 ml-3 d-none d-lg-block"
              href="login.html">login</a>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <div class="container20">
    <div class="usersection">
      <h1 class="comment box">Partager une idée</h1>
      <form class="form-idea" method="POST" action="">
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Entrez le nom d'utilisateur"
          required /><br />
        <input
          type="text"
          id="metier"
          name="job"
          placeholder="Entrez votre Metier"
          required /><br />
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Entrez Email"
          required />
        <br />

        <div class="opinion-conseils">
          <div class="option">
            <input
              type="radio"
              name="type"
              id="type-idee"
              value="opinion"
              checked />
            <label for="type-idee">Opinion</label>
          </div>
          <div class="option">
            <input
              type="radio"
              name="type"
              id="type-conseil"
              value="conseil" />
            <label for="type-conseil">Conseil</label>
          </div>
        </div>

        <textarea
          id="commentText"
          name="comment"
          rows="4"
          placeholder="Entrez vos commentaires ici"></textarea>
        <br />

        <button id="submitComment" class="button" name="submitComment" type="submit">
          Publier
        </button>
      </form>
    </div>
    <div class="Commentsection">
      <h2>Commentaires</h2>
      <div id="commentsContainer" class="comments-container"></div>
    </div>
  </div>
  <div class="mt-5 pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 about-company">
          <h2>Parcouris</h2>
          <p class="pr-5 text-white-50">Where we strive to become better</p>
          <p>
            <a href="#"><i class="fa fa-facebook-square mr-1"></i></a><a href="#"><i class="fa fa-linkedin-square"></i></a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-3">Links</h4>
          <ul class="m-0 p-0">
            <li>- <a href="#">Support</a></li>
            <li>- <a href="#">Linkedin</a></li>
            <li>- <a href="#">Facebook</a></li>
            <li>- <a href="#">Instagram</a></li>
            <li>- <a href="#">Github</a></li>
            <li>- <a href="#">Tiktok</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 location">
          <h4 class="mt-lg-0 mt-sm-4">Location</h4>
          <p>Sousse,Khzeama,4071</p>
          <p class="mb-0"><i class="fa fa-phone mr-3"></i>+216 12345678</p>
          <p><i class="fa fa-envelope-o mr-3"></i>info@parcouris.com</p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col copyright">
          <p class="">
            <small class="text-white-50">© 2024. All Rights Reserved.</small>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="./js/script.js"></script>
<script src="./js/comments.js"></script>

</html>

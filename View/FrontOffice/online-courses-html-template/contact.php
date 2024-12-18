
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>contact parcouri</title>
    <link rel="stylesheet" href="css/site.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  </head> 
  <body>
    <!-- Nouveau Navbar -->
    <div class="container-fluid">
      <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
          <div class="d-flex align-items-start">
            <img
              href="index.html"
              class="logo-img"
              src="img/img1.png"
              alt=""
              style="width: 50px; margin-left: 0;"
            />
            <h1
              class="logo-text"
              style="position: relative; top: 38px; margin-left: -15px; text-transform: lowercase;"
            >
              arcouri
            </h1>
          </div>
        </div>
        <div class="col-lg-9">
          <nav
            class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0"
          >
            <div
              class="collapse navbar-collapse justify-content-between"
              id="navbarCollapse"
            >
              <div class="navbar-nav py-0">
                <a
                  href="index.html"
                  class="nav-item nav-link"
                  style="margin-left: 5px;"
                  >Accueil</a
                >
                <div
                  class="nav-item dropdown"
                  style="margin-left: 5px;"
                >
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    >Internationale</a
                  >
                  <div class="dropdown-menu rounded-0 m-0">
                    <a href="blog.html" class="dropdown-item">Bourses d'Études</a>
                    <a href="single.html" class="dropdown-item"
                      >Programmes d'Échange</a
                    >
                  </div>
                </div>
                <div
                  class="nav-item dropdown"
                  style="margin-left: 5px;"
                >
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    >Activités</a
                  >
                  <div class="dropdown-menu rounded-0 m-0">
                    <a href="formations,clubs.php" class="dropdown-item"
                      >Clubs/Associations</a
                    >
                    <a href="single.html" class="dropdown-item">Formations</a>
                  </div>
                </div>
                <a
                  href="course.html"
                  class="nav-item nav-link"
                  style="margin-left: 5px;"
                  >Quiz</a
                >
                <a
                  href="teacher.html"
                  class="nav-item nav-link"
                  style="margin-left: 5px;"
                  >Témoignages</a
                >
                <a
                  href="contact.php"
                  class="nav-item nav-link"
                  style="margin-left: 5px;"
                  >Contact</a
                >
              </div>
              <div class="nav-buttons d-flex align-items-center">
                <a class="btn btn-primary custom-btn" href="signup.html">Sign In</a>
                <a
                  class="btn btn-primary custom-btn"
                  href="login.html"
                  style="margin-left: 5px;"
                  >Login</a
                >
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <section class="contact-section">
      <!-- Nouvelle image avec effet au survol -->
      <div class="contact-image">
        <img src="img/contact.jpeg" alt="Contactez-nous" />
        <div class="contact-info">
          <h2>C'est quoi Parcouri ?</h2>
          <p>
            Notre site Parcouri est une plateforme dédiée aux étudiants tunisiens, 
            visant à simplifier l'accès aux opportunités académiques et professionnelles. 
            Il regroupe des informations sur les bourses, les clubs étudiants, et les formations,
            le tout organisé pour une recherche rapide et personnalisée.
          </p>
        </div>
      </div>

      <!-- Boîtes de contact -->
      <div class="contact-boxes">
        <div class="contact-box">
          <div class="contact-item">
            <img src="img/prox.png" alt="Adresse" class="contact-icon" />
            <p>Adresse: Esprit, Ghazella</p>
          </div>
        </div>
        <div class="contact-box">
          <div class="contact-item">
            <img src="img/tel.png" alt="Appeler nous" class="contact-icon" />
            <p>Appeler nous: +216 25252525</p>
          </div>
        </div>
        <div class="contact-box">
          <div class="contact-item">
            <img src="img/mail.png" alt="Email" class="contact-icon" />
            <p>Email: parcouri@gmail.com</p>
          </div>
        </div>
      </div>

      <div class="address-image">
        <img src="img/ad.png" alt="Adresse" />
        <a href="https://maps.google.com/maps?q=ESPRIT+Tunis&ll=36.8991066,10.1871424&z=15" 
           target="_blank" 
           class="maps-button">
            Maps
        </a>
    </div>
    </section>

    <!-- Suggestion Section -->
    <section class="suggestion-section">
      <div class="suggestion-box">
        <div class="row">
          <!-- Texte à gauche -->
          <div class="col-md-6 text-box">
            <h2>Si vous avez une réclamation ou suggestion, n'hésitez pas à nous aider !</h2>
            <p>
              Vos retours sont essentiels pour nous aider à mieux comprendre vos attentes, afin que nous puissions mettre en place des solutions 
              qui répondent parfaitement à vos besoins. Que ce soit pour des améliorations sur le site, des fonctionnalités supplémentaires ou 
              des ajustements de nos services.Merci de faire partie de cette aventure avec nous et de nous aider à faire évoluer nos services pour 
              mieux vous servir.
            </p>
          </div>

          <!-- Formulaire à droite -->
          <div class="col-md-6 form-box">
            <form method="POST" action="\projetweb\view\backoffice\octopus-master\octopus-master\octopus\addsuggestion.php" id="suggestionForm">
                <input type="email" id="user_email" name="mail" class="input-field" placeholder="Votre Email"  />
                <select id="subject" name="type_feedback" class="input-field">
                    <option value="" disabled selected>Choisir un sujet</option>
                    <option value="reclamation">Réclamation</option>
                    <option value="suggestion">Suggestion</option>
                </select>
                <textarea id="message" name="contenu" class="input-field message-field" placeholder="Votre message"></textarea>
                <button type="submit" class="main-button">Envoyer</button>
            </form>
        </div>
        
      </div>
    </section>    
    <div class="suggestions-list">
      <h3>Suggestions</h3>
      <h4>Veuillez consulter les suggestions et donner votre avis pour nous aidez a mieux comprendre vos attentes !</h4>
      <div id="suggestions-container"></div>
      <div id="pagination-controls"></div>
  </div>
  

  
  <style>
    .like-button, .dislike-button {
    padding: 5px 10px;
    margin-left: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
}

.like-button {
    background-color: #4caf50; /* Vert */
    color: white;
}

.dislike-button {
    background-color: #f44336; /* Rouge */
    color: white;
}

.like-button:hover {
    background-color: #45a049;
}

.dislike-button:hover {
    background-color: #e53935;
}

    
      .suggestions-list {
          max-width: 1200px;
          margin: 30px auto;
          padding: 20px;
          background: #ffffff;
          border-radius: 10px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      }
      
  
      .suggestions-list h3 {
          font-size: 2rem;
          margin-bottom: 30px;
          color: #333;
          font-weight: bold;
      }
  
      .suggestions-list h4 {
          font-size: 1.2rem;
          color: #333;
          margin-bottom: 30px;
      }
  
      .suggestion-item {
          padding: 15px;
          margin-bottom: 15px;
          background-color: #ffffff;
          border-radius: 8px;
          border: 1px solid #ddd;
      }
      .suggestion-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            border: 1px solid #ddd;
        }
  
      /* Pagination */
      #pagination-controls {
          display: flex;
          justify-content: center;
          margin-top: 20px;
      }
  
      .pagination-button {
          padding: 8px 15px;
          margin: 0 5px;
          border-radius: 5px;
          border: 1px solid #ddd;
          background-color: #ffffff;
          color: #333;
          font-size: 1rem;
          cursor: pointer;
      }
  
      .pagination-button:hover {
          background-color: #de4747;
          color: #ffffff;
      }
  
      .pagination-button.active {
          background-color: #000;
          color: #ffffff;
      }
  </style>
  
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      const suggestionsContainer = document.getElementById('suggestions-container');
      const paginationControls = document.getElementById('pagination-controls');
      let currentPage = 1;
      const suggestionsPerPage = 3;

      function loadSuggestions(page) {
          fetch(`/projetweb/view/backoffice/octopus-master/octopus-master/octopus/getSuggestions.php?page=${page}&limit=${suggestionsPerPage}`)
              .then(response => response.json())
              .then(data => {
                  if (data.error) {
                      console.error('Erreur:', data.error);
                      return;
                  }
                  suggestionsContainer.innerHTML = '';
                  data.suggestions.forEach(suggestion => {
                    const suggestionDiv = document.createElement('div');
                    suggestionDiv.classList.add('suggestion-item');
                    suggestionDiv.dataset.id = suggestion.id_suggestion; // Ajout de l'ID

                    suggestionDiv.innerHTML = `
    <div style="display: flex; align-items: center;">
        <div style="flex-grow: 1;">
            <p>${suggestion.contenu}</p>
            <small>${suggestion.date_soumission}</small>
        </div>
        <div>
            <button class="like-button" onclick="handleLike(this)">Like (${suggestion.likes})</button>
            <button class="dislike-button" onclick="handleDislike(this)">Dislike (${suggestion.dislikes})</button>
        </div>
    </div>
`;

                    suggestionsContainer.appendChild(suggestionDiv);
                });



                  // Pagination
                  paginationControls.innerHTML = '';
                  for (let i = 1; i <= Math.ceil(data.total / suggestionsPerPage); i++) {
                      const pageLink = document.createElement('button');
                      pageLink.textContent = i;
                      pageLink.classList.add('pagination-button');
                      if (i === page) pageLink.classList.add('active');
                      pageLink.addEventListener('click', () => loadSuggestions(i));
                      paginationControls.appendChild(pageLink);
                  }
              })
              .catch(error => console.error('Erreur lors du chargement des suggestions:', error));
      }

      loadSuggestions(currentPage);
     });
     function handleLike(button) {
    const suggestionId = button.closest('.suggestion-item').dataset.id;

    fetch('/projetweb/view/backoffice/octopus-master/octopus-master/octopus/updateFeedback.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json'  // Utiliser JSON
        },
        body: JSON.stringify({
            id_suggestion: suggestionId,
            action: 'like'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Votre "Like" a été enregistré!');
            const likeButton = button;
            const likeCount = likeButton.textContent.match(/\d+/);
            likeButton.textContent = `Like (${parseInt(likeCount) + 1 || 1})`;
        } else {
            console.error('Erreur:', data.error);
            alert('Une erreur est survenue lors de l\'enregistrement.');
        }
    })
    .catch(error => console.error('Erreur réseau:', error));
}

function handleDislike(button) {
    const suggestionId = button.closest('.suggestion-item').dataset.id;

    fetch('/projetweb/view/backoffice/octopus-master/octopus-master/octopus/updateFeedback.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json'  // Utiliser JSON
        },
        body: JSON.stringify({
            id_suggestion: suggestionId,
            action: 'dislike'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Votre "Dislike" a été enregistré!');
            const dislikeButton = button;
            const dislikeCount = dislikeButton.textContent.match(/\d+/);
            dislikeButton.textContent = `Dislike (${parseInt(dislikeCount) + 1 || 1})`;
        } else {
            console.error('Erreur:', data.error);
            alert('Une erreur est survenue lors de l\'enregistrement.');
        }
    })
    .catch(error => console.error('Erreur réseau:', error));
}

    
    </script>  
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
   
    

     
  </body>
</html>

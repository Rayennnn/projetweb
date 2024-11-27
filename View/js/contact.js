document.addEventListener('DOMContentLoaded', function() {
    const suggestionForm = document.getElementById('suggestionForm');

    // Fonction pour créer et afficher une alerte stylée
    function showAlert(message, type = 'error') {
        // Créer le conteneur d'alerte s'il n'existe pas
        let alertContainer = document.getElementById('alert-container');
        if (!alertContainer) {
            alertContainer = document.createElement('div');
            alertContainer.id = 'alert-container';
            alertContainer.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1000;
                width: auto;
                min-width: 300px;
                padding: 15px 20px;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;
            document.body.appendChild(alertContainer);
        }

        // Définir la couleur en fonction du type
        const backgroundColor = type === 'error' ? '#ff4444' : '#00C851';
        alertContainer.style.backgroundColor = backgroundColor;
        alertContainer.style.color = 'white';

        // Créer le contenu de l'alerte
        alertContainer.innerHTML = `
            <span>${message}</span>
            <button onclick="this.parentElement.style.opacity = '0';" style="
                background: transparent;
                border: none;
                color: white;
                cursor: pointer;
                margin-left: 15px;
                font-size: 18px;
            ">&times;</button>
        `;

        // Afficher l'alerte avec animation
        setTimeout(() => alertContainer.style.opacity = '1', 10);

        // Masquer l'alerte après 5 secondes
        setTimeout(() => {
            alertContainer.style.opacity = '0';
        }, 5000);
    }

    suggestionForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Empêcher la soumission par défaut

        // Récupérer les valeurs des champs
        var userId = document.getElementById('user_id').value;
        var subject = document.getElementById('subject').value;
        var message = document.getElementById('message').value;

        // Validation
        if (!userId.trim() || !subject || !message.trim()) {
            showAlert("Tous les champs doivent être remplis !");
            return;
        }

        if (message.length < 10) {
            showAlert("Le message doit contenir au moins 10 caractères.");
            return;
        }

        // Si tout est valide, soumettre le formulaire via AJAX
        const formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('success')) {
                showAlert('Message envoyé avec succès !', 'success');
                // Optionnel : réinitialiser le formulaire
                suggestionForm.reset();
            } else {
                showAlert('Erreur lors de l\'envoi du message.');
            }
        })
        .catch(error => {
            showAlert('Erreur lors de l\'envoi du message : ' + error.message);
        });
    });

    // Le reste du code de validation en temps réel reste inchangé
    // ... (garder le code de validation des champs et les effets visuels)
});

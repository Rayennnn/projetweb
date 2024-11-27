document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    // Fonction de validation du nom du club
    function validateNomClub(nom) {
        if (nom.trim().length < 3) {
            console.log('Erreur: Le nom du club doit contenir au moins 3 caractères');
            document.getElementById('nomError').textContent = 'Le nom du club doit contenir au moins 3 caractères';
            return false;
        }
        document.getElementById('nomError').textContent = '';
        return true;
    }

    // Fonction de validation de la description
    function validateDescription(description) {
        if (description.trim().length < 10) {
            console.log('Erreur: La description doit contenir au moins 10 caractères');
            document.getElementById('descriptionError').textContent = 'La description doit contenir au moins 10 caractères';
            return false;
        }
        document.getElementById('descriptionError').textContent = '';
        return true;
    }

    // Fonction de validation de la date
    function validateDate(date) {
        if (!date) {
            return false;
        }
        const selectedDate = new Date(date);
        const currentDate = new Date();
        if (selectedDate > currentDate) {
            return false;
        }
        return true;
    }

    // Fonction de validation du logo
    function validateLogo(logoFile) {
        if (logoFile) {
            // Vérifier le type de fichier
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(logoFile.type)) {
                console.log('Erreur: Format de fichier non valide');
                document.getElementById('logoError').textContent = 'Le logo doit être au format JPG, PNG ou GIF';
                return false;
            }

            // Vérifier la taille du fichier (max 5MB)
            if (logoFile.size > 5 * 1024 * 1024) {
                console.log('Erreur: Taille du fichier trop grande');
                document.getElementById('logoError').textContent = 'La taille du logo ne doit pas dépasser 5MB';
                return false;
            }
        }
        document.getElementById('logoError').textContent = '';
        return true;
    }

    // Validation en temps réel
    const nomInput = document.querySelector('[name="nom_club"]');
    nomInput.addEventListener('input', function() {
        console.log('Validation du nom:', this.value);
        validateNomClub(this.value);
    });

    const descriptionInput = document.querySelector('[name="description"]');
    descriptionInput.addEventListener('input', function() {
        console.log('Validation de la description:', this.value);
        validateDescription(this.value);
    });

    const logoInput = document.querySelector('[name="logo"]');
    logoInput.addEventListener('change', function() {
        console.log('Validation du logo:', this.files[0]);
        validateLogo(this.files[0]);
    });

    // Validation du formulaire
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Soumission du formulaire détectée");

        // Réinitialiser les messages d'erreur
        document.querySelectorAll('.error-message').forEach(error => error.textContent = '');

        // Récupérer et valider les données
        const nom = nomInput.value;
        const description = descriptionInput.value;
        const logo = logoInput.files[0];

        console.log('Données du formulaire:', {
            nom,
            description,
            logo: logo ? logo.name : 'Aucun fichier'
        });

        // Valider tous les champs
        const isNomValid = validateNomClub(nom);
        const isDescriptionValid = validateDescription(description);
        const isDateValid = validateDate(date);
        const isLogoValid = validateLogo(logo);

        console.log('Résultats de validation:', {
            nom: isNomValid,
            description: isDescriptionValid,
            logo: isLogoValid
        });

        // Si tout est valide
        if (isNomValid && isDescriptionValid && isDateValid && isLogoValid) {
            console.log("Formulaire valide, envoi...");
            const formData = new FormData(form);

            fetch('addClub.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Réponse:', data);
                alert('Club ajouté avec succès!');
                // Redirection vers listClubs.php
                window.location.href = 'listClubs.php';
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de l\'ajout du club');
            });
        } else {
            console.log('Formulaire invalide, envoi annulé');
        }
    });

    // Prévisualisation du logo
    logoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            console.log('Prévisualisation du logo:', file.name);
            const reader = new FileReader();
            reader.onload = function(e) {
                console.log('Logo chargé avec succès');
                const preview = document.getElementById('logoPreview') || document.createElement('div');
                preview.id = 'logoPreview';
                preview.innerHTML = `<img src="${e.target.result}" style="max-width: 200px; margin-top: 10px;">`;
                logoInput.parentNode.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
    });
});
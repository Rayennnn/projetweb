// Fonction de validation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bourseForm');
    const inputs = form.querySelectorAll('input, select, textarea');

    // Ajouter les écouteurs d'événements pour chaque champ
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(input);
        });
        input.addEventListener('blur', function() {
            validateField(input);
        });
    });
});

// Fonction de validation individuelle des champs
function validateField(field) {
    clearFieldError(field);
    
    switch(field.name) {
        case 'titre':
            validateTitre(field);
            break;
        case 'pays':
            validatePays(field);
            break;
        case 'dateLimite':
            validateDate(field);
            break;
        case 'niveau':
            validateNiveau(field);
            break;
        case 'description':
            validateDescription(field);
            break;
        case 'image':
            validateImage(field);
            break;
    }
}

// Fonctions de validation spécifiques
function validateTitre(field) {
    const value = field.value.trim();
    if (!value) {
        showError(field, "Le titre est obligatoire");
        return false;
    }
    if (value.length < 3) {
        showError(field, "Le titre doit contenir au moins 3 caractères");
        return false;
    }
    if (value.length > 100) {
        showError(field, "Le titre ne doit pas dépasser 100 caractères");
        return false;
    }
    if (!/^[a-zA-ZÀ-ÿ0-9\s'-]*$/.test(value)) {
        showError(field, "Le titre contient des caractères non autorisés");
        return false;
    }
    showSuccess(field);
    return true;
}

function validatePays(field) {
    if (!field.value) {
        showError(field, "Veuillez sélectionner un pays");
        return false;
    }
    showSuccess(field);
    return true;
}

function validateDate(field) {
    const selectedDate = new Date(field.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (!field.value) {
        showError(field, "La date limite est obligatoire");
        return false;
    }
    if (selectedDate < today) {
        showError(field, "La date limite doit être ultérieure à aujourd'hui");
        return false;
    }
    showSuccess(field);
    return true;
}

function validateNiveau(field) {
    if (!field.value) {
        showError(field, "Veuillez sélectionner un niveau d'études");
        return false;
    }
    showSuccess(field);
    return true;
}

function validateDescription(field) {
    const value = field.value.trim();
    if (!value) {
        showError(field, "La description est obligatoire");
        return false;
    }
    if (value.length < 50) {
        showError(field, "La description doit contenir au moins 50 caractères");
        return false;
    }
    if (value.length > 1000) {
        showError(field, "La description ne doit pas dépasser 1000 caractères");
        return false;
    }
    showSuccess(field);
    return true;
}

function validateImage(field) {
    if (field.files.length === 0) {
        showError(field, "Une image est requise");
        return false;
    }

    const file = field.files[0];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    const maxSize = 5 * 1024 * 1024; // 5MB

    if (!allowedTypes.includes(file.type)) {
        showError(field, "Format d'image non valide. Utilisez JPEG, PNG ou WEBP");
        return false;
    }

    if (file.size > maxSize) {
        showError(field, "L'image ne doit pas dépasser 5MB");
        return false;
    }

    showSuccess(field);
    return true;
}

// Fonctions utilitaires
function showError(field, message) {
    field.classList.add('is-invalid');
    field.classList.remove('is-valid');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    
    const parent = field.parentElement;
    parent.appendChild(errorDiv);
}

function showSuccess(field) {
    field.classList.remove('is-invalid');
    field.classList.add('is-valid');
}

function clearFieldError(field) {
    field.classList.remove('is-invalid', 'is-valid');
    const parent = field.parentElement;
    const errorDiv = parent.querySelector('.invalid-feedback');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Fonction de validation globale du formulaire
function validateForm() {
    const form = document.getElementById('bourseForm');
    const fields = form.querySelectorAll('input, select, textarea');
    let isValid = true;

    fields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    return isValid;
}

// Fonction de sauvegarde
function saveBourse() {
    if (validateForm()) {
        const formData = new FormData(document.getElementById('bourseForm'));
        
        // Simulation d'envoi au serveur
        console.log('Données valides, prêtes à être envoyées:', Object.fromEntries(formData));
        
        // Afficher un message de succès
        Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: 'La bourse a été ajoutée avec succès',
            showConfirmButton: false,
            timer: 1500
        });

        // Fermer le modal
        closeModal();
    }
}
function showAddModal() {
	document.getElementById('bourseModal').classList.add('show');
}

function closeModal() {
	document.getElementById('bourseModal').classList.remove('show');
}

function editBourse(id) {
	// Logique pour éditer une bourse
	showAddModal();
	// Remplir le formulaire avec les données existantes
}

function deleteBourse(id) {
	if(confirm('Êtes-vous sûr de vouloir supprimer cette bourse ?')) {
		// Logique pour supprimer une bourse
	}
}

function saveBourse() {
	// Logique pour sauvegarder une bourse
	closeModal();
	validerFormulaire();
}
// Contrôle de saisie pour le formulaire d'ajout de bourse
(function() {
    'use strict';

    // Fonction pour afficher les erreurs
    function showError(element, message) {
        // Supprimer les messages d'erreur existants
        const existingError = element.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        // Ajouter la classe d'erreur
        element.classList.add('is-invalid');
        
        // Créer et ajouter le message d'erreur
        const errorDiv = document.createElement('span');
        errorDiv.className = 'error-message text-danger';
        errorDiv.style.fontSize = '12px';
        errorDiv.textContent = message;
        element.parentNode.appendChild(errorDiv);
    }

    // Fonction pour supprimer les erreurs
    function removeError(element) {
        element.classList.remove('is-invalid');
        const errorDiv = element.parentNode.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // Fonction de validation d'URL
    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }

    // Fonction de validation de la date
    function isValidDate(date) {
        const selectedDate = new Date(date);
        const today = new Date();
        return selectedDate > today;
    }

    // Fonction principale de validation
    function validateForm(e) {
        let hasError = false;
        const form = e.target;

        // Validation du titre
        const titre = form.querySelector('input[name="titre"]');
        if (!titre.value.trim()) {
            showError(titre, 'Le titre est obligatoire');
            hasError = true;
        } else if (titre.value.length < 3 || titre.value.length > 100) {
            showError(titre, 'Le titre doit contenir entre 3 et 100 caractères');
            hasError = true;
        } else {
            removeError(titre);
        }

        // Validation de la description
        const desc = form.querySelector('textarea[name="desc"]');
        if (!desc.value.trim()) {
            showError(desc, 'La description est obligatoire');
            hasError = true;
        } else if (desc.value.length < 10) {
            showError(desc, 'La description doit contenir au moins 10 caractères');
            hasError = true;
        } else {
            removeError(desc);
        }

        // Validation de l'organisme
        const organisme = form.querySelector('input[name="organisme"]');
        if (!organisme.value.trim()) {
            showError(organisme, 'L\'organisme est obligatoire');
            hasError = true;
        } else {
            removeError(organisme);
        }

        // Validation de la date limite
        const dateLimite = form.querySelector('input[name="dateLimite"]');
        if (!dateLimite.value) {
            showError(dateLimite, 'La date limite est obligatoire');
            hasError = true;
        } else if (!isValidDate(dateLimite.value)) {
            showError(dateLimite, 'La date limite doit être ultérieure à aujourd\'hui');
            hasError = true;
        } else {
            removeError(dateLimite);
        }

        // Validation de l'âge limite
        const ageLimite = form.querySelector('input[name="age_limite"]');
        if (!ageLimite.value) {
            showError(ageLimite, 'L\'âge limite est obligatoire');
            hasError = true;
        } else if (ageLimite.value < 16 || ageLimite.value > 100) {
            showError(ageLimite, 'L\'âge limite doit être entre 16 et 100 ans');
            hasError = true;
        } else {
            removeError(ageLimite);
        }

        // Validation du niveau d'études
        const niveau = form.querySelector('select[name="niveau"]');
        if (!niveau.value) {
            showError(niveau, 'Le niveau d\'études est obligatoire');
            hasError = true;
        } else {
            removeError(niveau);
        }

        // Validation du pays
        const pays = form.querySelector('select[name="pays"]');
        if (!pays.value) {
            showError(pays, 'Le pays est obligatoire');
            hasError = true;
        } else {
            removeError(pays);
        }

        // Validation du lien
        const lien = form.querySelector('input[name="lien"]');
        if (!lien.value.trim()) {
            showError(lien, 'Le lien est obligatoire');
            hasError = true;
        } else if (!isValidUrl(lien.value)) {
            showError(lien, 'Veuillez entrer une URL valide');
            hasError = true;
        } else {
            removeError(lien);
        }

        // Validation de l'image
        const image = form.querySelector('input[name="image"]');
        if (image.files.length > 0) {
            const file = image.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedTypes.includes(file.type)) {
                showError(image, 'Format d\'image non valide. Utilisez JPG, PNG ou GIF');
                hasError = true;
            } else if (file.size > maxSize) {
                showError(image, 'L\'image ne doit pas dépasser 5MB');
                hasError = true;
            } else {
                removeError(image);
            }
        } else if (!image.hasAttribute('data-update')) { // Si ce n'est pas une mise à jour
            showError(image, 'L\'image est obligatoire');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            // Scroll vers la première erreur
            const firstError = form.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }

    // Initialisation des validations
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', validateForm);

            // Validation en temps réel
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    removeError(this);
                });
                input.addEventListener('change', function() {
                    removeError(this);
                });
            });
        }
    });
})();
			
			
			

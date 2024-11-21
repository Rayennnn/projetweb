document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du graphique
    let clubsChart;
 
    const initChart = () => {
        const ctx = document.getElementById('clubsChart').getContext('2d');
        clubsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Culture', 'Sport', 'Technologie', 'Art', 'Social', 'Scientifique', 'Environnement'],
                datasets: [{
                    data: [3, 4, 2, 1, 2, 1, 1], // Données fictives
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40', '#47B39C'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    };
 
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
    const validateForm = () => {
        const form = document.querySelector('form');
        const nomInput = document.querySelector('[name="nom_club"]');
        const descriptionInput = document.querySelector('[name="description"]');
        const logoInput = document.querySelector('[name="logo"]');
        const successMessage = document.querySelector('#formSuccess');
 
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log('Soumission du formulaire...');
 
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
            const isLogoValid = validateLogo(logo);

            console.log('Résultats de validation:', {
                nom: isNomValid,
                description: isDescriptionValid,
                logo: isLogoValid
            });

            // Si tout est valide
            if (isNomValid && isDescriptionValid && isLogoValid) {
                console.log('Formulaire valide, envoi des données...');
                const formData = new FormData(form);
 
                // Envoi des données via AJAX (fetch)
                fetch('../../../Controller/add_club.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        console.log('Réponse reçue:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Données reçues:', data);
                        if (data.success) {
                            console.log('Succès: Club ajouté');
                            successMessage.textContent = data.message;
                            successMessage.style.color = 'green';
                            form.reset();
                            document.querySelector('#logoPreview').innerHTML = '';
                            updateStats();
                        } else {
                            console.error('Erreur:', data.error || 'Une erreur est survenue');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'envoi:', error);
                    });
            } else {
                console.log('Formulaire invalide, envoi annulé');
            }
        });
    };
 
    // Aperçu du logo
    const initLogoPreview = () => {
        const logoInput = document.querySelector('[name="logo"]');
        const previewDiv = document.querySelector('#logoPreview');
 
        logoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                console.log('Prévisualisation du logo:', file.name);
                const reader = new FileReader();
                reader.onload = function (e) {
                    console.log('Logo chargé avec succès');
                    previewDiv.innerHTML = `<img src="${e.target.result}" alt="Aperçu du logo" style="max-width: 200px;">`;
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = ''; // Réinitialiser si aucun fichier n'est sélectionné
            }
        });
    };
 
    // Mettre à jour les statistiques dynamiquement
    const updateStats = () => {
        fetch('get_club_stats.php')
            .then(response => {
                if (!response.ok) {
 throw new Error('Erreur lors de la récupération des statistiques.');
                }
                return response.json();
            })
            .then(data => {
                // Mettre à jour les données des statistiques
                document.querySelector('.amount').textContent = data.totalClubs;
                clubsChart.data.datasets[0].data = data.categoriesData;
                clubsChart.update();
            })
            .catch(error => console.error('Erreur:', error));
    };
 
    // Initialisation
    initChart();
    validateForm();
    initLogoPreview();
 });